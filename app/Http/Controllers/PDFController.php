<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use App\Models\register_form;
use App\Models\assign;
use App\Models\attendance;
use App\Models\corevalues;
use App\Models\grade;
use App\Models\payment_form;
use Barryvdh\DomPDF\PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PDFController extends Controller
{
    public function generatePDF(Request $request)
{
    // Get the authenticated user
    $user = Auth::user();

    // Find the register form associated with the authenticated user
    $registerForm = register_form::where('user_id', $user->id)->first();

    if (!$registerForm) {
        return redirect()->back()->withErrors('Student not found.');
    }

    // Use the register form ID to get assigned classes
    $assignedClasses = assign::where('class_id', $registerForm->id)->get();

    // Get the payment proof associated with the register form
    $proof = payment_form::where('payment_id', $registerForm->id)->first();

    // Prepare the data to be passed to the PDF view
    $data = [
        'student' => $registerForm,
        'assignedClasses' => $assignedClasses,
        'proof' => $proof,
    ];

    // Prepare the PDF with the relevant data
    $pdf = FacadePdf::loadView('studentclassload', $data);

    $pdf->setPaper('A4', 'portrait');
    $pdf->set_option('isHtml5ParserEnabled', true);
    $pdf->set_option('isRemoteEnabled', true);

    return $pdf->download('student_class_load.pdf');
}


public function downloadReportCard($grade_id, $core_id, $attendance_id)
{
    // Fetch core values using core_id
    $coreValues = corevalues::where('core_id', $core_id)->first();

    if (!$coreValues) {
        Log::info("Core values not found for core_id: {$core_id}");
        return response()->json(['error' => 'Core values not found.'], 404);
    }

    // Fetch grades for the student
    $grades = Grade::where('fullname', $coreValues->fullname)
                   ->where('section', $coreValues->section)
                   ->where('status', 'approved')
                   ->get();

    if ($grades->isEmpty()) {
        Log::info("Grades not found for fullname: {$coreValues->fullname}");
        return response()->json(['error' => 'Grades not found for the student.'], 404);
    }

    // Fetch attendance records for the student
    $attendance = Attendance::where('fullname', $coreValues->fullname)
                            ->where('section', $coreValues->section)
                            ->get();

    if ($attendance->isEmpty()) {
        Log::info("Attendance records not found for fullname: {$coreValues->fullname}");
        return response()->json(['error' => 'Attendance records not found for the student.'], 404);
    }

    // Prepare data for the report card
    $reportCardData = [
        'fullname' => $coreValues->fullname,
        'section' => $coreValues->section,
        'grade_level' => $coreValues->grade_level,
        'grades' => $grades,
        'attendance' => $attendance,
        'core_values' => $coreValues,
    ];

    // Generate PDF
    $pdf = FacadePdf::loadView('reportCardPDF', compact('reportCardData'));
    $pdf->setPaper('A4', 'portrait');
$pdf->set_option('isHtml5ParserEnabled', true);
$pdf->set_option('isRemoteEnabled', true);
$pdf->set_option('defaultFont', 'Arial'); // Optional: Set default font for PDF

    return $pdf->download('report_card_' . str_replace(' ', '_', $coreValues->fullname) . '.pdf');
}
}
