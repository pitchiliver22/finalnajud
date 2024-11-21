<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use App\Models\register_form;
use App\Models\assign;
use App\Models\payment_form;
use Illuminate\Support\Facades\Auth;

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
}
