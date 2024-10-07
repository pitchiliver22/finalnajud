<?php

namespace App\Http\Controllers;

use App\Models\address;
use App\Models\previous_school;
use App\Models\register_form;
use App\Models\required_docs;
use App\Models\studentdetails;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Pagecontroller extends Controller
{

    public function user()
    {
        $users = User::all();
        return view('user', compact('users'));
    }
    public function login()
    {
        return view('login');
    }
    public function partialaccount()
    {
        return view('partialaccount');
    }
    public function register_consent()
    {
        return view('register_consent');
    }

    public function studentdetails()
    {
        $details = studentdetails::all();

        return view('studentdetails', compact('details'));
    }

    public function address_contact()
    {
        return view('address_contact');
    }

    public function required_documents()
    {
        return view('required_documents');
    }

    public function previous_school()
    {
        return view('previous_school');
    }

    public function payment_process()
    {
        return view('payment_process');
    }

    public function studentdashboard()
    {
        return view('studentdashboard');
    }
    public function studentclassload()
    {
        return view('studentclassload');
    }

    public function studentprofile()
    {
        return view('studentprofile');
    }

    public function enrollmentstep()
    {
        $details = studentdetails::all();


        return view('enrollmentstep', compact('details'));
    }

    public function studentgrades()
    {
        return view('studentgrades');
    }

    public function studentassessment()
    {
        return view('studentassessment');
    }

    //teacher 
    public function teacher()
    {
        return view('teacher');
    }
    public function teachernotification()
    {
        return view('teachernotification');
    }
    public function teacherprofile()
    {
        return view('teacherprofile');
    }
    public function teacherclassload()
    {
        return view('teacherclassload');
    }
    public function gradesubmit()
    {
        return view('gradesubmit');
    }
    public function teacherattendance()
    {
        return view('teacherattendance');
    }
    public function teachercorevalue()
    {
        return view('teachercorevalue');
    }

    //principal
    public function principal()
    {
        return view('principal');
    }
    public function sectioning()
    {
        return view('sectioning');
    }
    public function principalclassload()
    {
        return view('principalclassload');
    }

    //accounting
    public function accounting()
    {
        return view('accounting');
    }

    public function accountingassessment()
    {
        return view('accountingassessment');
    }
    public function createassessmet()
    {
        return view('createassessmet');
    }
    public function accountingprofile()
    {
        return view('accountingprofile');
    }


    //record
    public function record()
    {
        return view('record');
    }
    public function studentapplicant()
    {
        $account = register_form::all();

        return view('studentapplicant', compact('account'));
    }
    public function  recordapproval()
    {
        $account = register_form::all();

        return view(' recordapproval', compact('account'));
    }


    //cashier 
    public function cashier()
    {
        return view('cashier');
    }
    public function cashieraddfee()
    {
        return view('cashieraddfee');
    }
    public function cashierstudentfee()
    {
        return view('cashierstudentfee');
    }

    public function proofofpayment()
    {
        return view('proofofpayment');
    }

    //admin
    public function admin()
    {
        return view('admin');
    }

    public function adminmanageclassload()
    {
        return view('adminmanageclassload');
    }
    public function adminstudent()
    {
        return view('adminstudent');
    }
    public function adminreport()
    {
        return view('adminreport');
    }
    public function adminusers()
    {
        $account = User::all();
        return view('adminusers', compact('account'));
    }
    public function adminnotification()
    {
        return view('adminnotification');
    }

    public function adminprofile()
    {
        return view('adminprofile');
    }
    public function updatedetails()
    {

        $user = Auth::user();


        if (!$user || !$user->details_id) {
            return redirect('/enrollmentstep')->with('error', 'Details not found.');
        }

        $details = studentdetails::findOrFail($user->details_id);

        return view('updatedetails', compact('details'));
    }
    public function updateaddress()
    {

        $user = Auth::user();


        if (!$user || !$user->address_id) {
            return redirect('/enrollmentstep')->with('error', 'Details not found.');
        }


        $address = address::findOrFail($user->address_id);

        return view('updateaddress', compact('address'));
    }
    public function updatedocuments()
    {
        $user = Auth::user();


        if (!$user || !$user->required_id) {
            return redirect('/enrollmentstep')->with('error', 'Details not found.');
        }


        $docs = required_docs::findOrFail($user->required_id);

        return view('updatedocuments', compact('docs'));
    }
    public function updateschool()
    {
        $user = Auth::user();


        if (!$user || !$user->school_id) {
            return redirect('/enrollmentstep')->with('error', 'Details not found.');
        }


        $school = previous_school::findOrFail($user->school_id);

        return view('updateschool', compact('school'));
    }
}
