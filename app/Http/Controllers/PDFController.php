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
        $userId = Auth::id();


        $assignedClasses = assign::where('class_id', $userId)->get();


        $student = register_form::find($userId);
        if (!$student) {
            return redirect()->back()->withErrors('Student not found.');
        }


        $proof = payment_form::where('payment_id', $userId)->first();


        $pdf = FacadePdf::loadView('studentclassload', [
            'student' => $student,
            'assignedClasses' => $assignedClasses,
            'proof' => $proof,
        ]);


        $pdf->setPaper('A4', 'portrait');
        $pdf->set_option('isHtml5ParserEnabled', true);
        $pdf->set_option('isRemoteEnabled', true);

        return $pdf->download('student_class_load.pdf');
    }
}
