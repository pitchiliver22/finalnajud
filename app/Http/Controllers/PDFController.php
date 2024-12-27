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
use App\Models\User;
use Barryvdh\DomPDF\PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Log;

class PDFController extends Controller
{
    public function generatePDF(Request $request)
{
    $user = Auth::user();

    $registerForm = register_form::where('user_id', $user->id)->first();

    if (!$registerForm) {
        return redirect()->back()->withErrors('Student not found.');
    }

    $assignedClasses = assign::where('class_id', $registerForm->id)->get();

    $proof = payment_form::where('payment_id', $registerForm->id)->first();

    $data = [
        'student' => $registerForm,
        'assignedClasses' => $assignedClasses,
        'proof' => $proof,
    ];

    $pdf = FacadePdf::loadView('studentclassload', $data);

    $pdf->setPaper('A4', 'portrait');
    $pdf->set_option('isHtml5ParserEnabled', true);
    $pdf->set_option('isRemoteEnabled', true);

    return $pdf->download('student_class_load.pdf');
}


public function downloadReportCard($grade_id, $core_id, $attendance_id)
{
   
    $authUserCoreId = Auth::user()->core_id;


    $coreValues = corevalues::where('core_id', $core_id)->first();

    if (!$coreValues) {
        Log::info("Core values not found for core_id: {$core_id}");
        return response()->json(['error' => 'Core values not found.'], 404);
    }

  
    $grades = Grade::where('fullname', $coreValues->fullname)
                   ->where('section', $coreValues->section)
                   ->where('status', 'approved')
                   ->get();

    if ($grades->isEmpty()) {
        Log::info("Grades not found for fullname: {$coreValues->fullname}");
        return response()->json(['error' => 'Grades not found for the student.'], 404);
    }

    $attendance = Attendance::where('fullname', $coreValues->fullname)
                            ->where('section', $coreValues->section)
                            ->get();

    if ($attendance->isEmpty()) {
        Log::info("Attendance records not found for fullname: {$coreValues->fullname}");
        return response()->json(['error' => 'Attendance records not found for the student.'], 404);
    }

    $reportCardData = [
        'fullname' => $coreValues->fullname,
        'section' => $coreValues->section,
        'grade_level' => $coreValues->grade_level,
        'grades' => $grades,
        'attendance' => $attendance,
        'core_values' => $coreValues,
    ];

    $pdf = FacadePdf::loadView('reportCardPDF', compact('reportCardData'));
    $pdf->setPaper('A4', 'landscape'); 
    $pdf->set_option('isHtml5ParserEnabled', true);
    $pdf->set_option('isRemoteEnabled', true);
    $pdf->set_option('defaultFont', 'Arial'); 

    return $pdf->download('report_card_' . str_replace(' ', '_', $coreValues->fullname) . '.pdf');
}

public function generateReport() {
    
    $oldStudents = User::where('role', 'Oldstudent')->get(); 
    $newStudents = User::where('role', 'Newstudent')->get(); 

    $pdf = FacadePdf::loadView('student_report_pdf', compact('oldStudents', 'newStudents'));
    return $pdf->download('students_report.pdf');
}

public function generateAccountingReport() {
    $accountingStaff = User::where('role', 'Accounting')->get(); 
    $totalAccounting = $accountingStaff->count(); 

   
    $pdf = FacadePdf::loadView('accounting_report_pdf', compact('accountingStaff', 'totalAccounting'));
    
   
    return $pdf->download('accounting_staff_report.pdf');
}

public function generateTeacherReport() {
    $teachers = User::where('role', 'Teacher')->get(); 
    $totalteachers = $teachers->count(); 

   
    $pdf = FacadePdf::loadView('teacher_report_pdf', compact('teachers', 'totalteachers'));
    
   
    return $pdf->download('Teacher_report.pdf');
}

public function generatePrincipalReport() {
    $principals = User::where('role', 'Principal')->get();
    $totalPrincipal = $principals->count();

   
    $pdf = FacadePdf::loadView('principal_report_pdf', compact('principals', 'totalPrincipal'));
    
   
    return $pdf->download('Principal_report.pdf');
}

public function generateRecordReport() {
    $totalRecord = User::where('role', 'Record')->get();
    $countRecord = $totalRecord->count();

   
    $pdf = FacadePdf::loadView('record_report_pdf', compact('totalRecord', 'countRecord'));
    
   
    return $pdf->download('Record_report.pdf');
}

public function generateCashierReport() {
    $cashiers = User::where('role', 'Cashier')->get();
    $totalCashiers = $cashiers->count();

   
    $pdf = FacadePdf::loadView('cashier_report_pdf', compact('cashiers', 'totalCashiers'));
    
   
    return $pdf->download('Cashier_report.pdf');
}
}
