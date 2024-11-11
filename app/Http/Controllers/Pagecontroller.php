<?php

namespace App\Http\Controllers;

use App\Models\address;
use App\Models\assign;
use App\Models\classes;
use App\Models\grade;
use App\Models\payment_form;
use App\Models\previous_school;
use App\Models\register_form;
use App\Models\required_docs;
use App\Models\section;
use App\Models\studentdetails;
use App\Models\teacher;
use App\Models\User;
use Illuminate\Support\Facades\Log;
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
        sweetalert()->warning('This is your partial account so please fill up all the details asked.');
        return view('partialaccount');
    }
    public function register_consent()
    {
        sweetalert()->info('This is optional only but we need the consent of your parents first.');
        return view('register_consent');
    }

    public function studentdetails()
    {
        $details = studentdetails::all();

        return view('studentdetails', compact('details'));
    }

    public function address_contact()
    {
        
        
    return view('address_contact'); // Pass it to the view
    }

    public function required_documents()
    {
        return view('required_documents');
    }

    public function previous_school()
    {
        $userId = Auth::user()->id; 
        return view('previous_school',compact('userId'));
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

    public function enrollmentStep()
{
    // Ensure the user is authenticated
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    $user = Auth::user();
    // Fetch the register form associated with the authenticated user
    $registerForm = register_form::where('user_id', $user->id)->first(); // Assuming user_id links to register_form

    if (!$registerForm) {
        return redirect()->route('some.route')->with('error', 'No registration form found.');
    }

    // Use registerForm ID to get related details
    $details = studentdetails::where('details_id', $registerForm->id)->first();
    $address = address::where('address_id', $registerForm->id)->first(); // Assuming the relationship is correct
    $previousSchool = previous_school::where('school_id', $registerForm->id)->first();
    $requiredDocs = required_docs::where('required_id', $registerForm->id)->first();
    $payment = payment_form::where('payment_id', $registerForm->id)->first(); // Adjust as needed
    $assignStatus = assign::where('class_id', $registerForm->id)->first(); // Adjust as needed

    return view('enrollmentstep', compact('details', 'address', 'previousSchool', 'requiredDocs', 'payment', 'assignStatus'));
}

    public function studentgrades()
    {
        $userId = Auth::id();

        // Fetch all approved grades for the authenticated user based on the grade_id
        $grades = Grade::where('grade_id', $userId) // Check if the authenticated user's ID matches the grade_id
            ->where('status', 'approved') // Only fetch approved grades
            ->get(['subject', 'edp_code', 'section', '1st_quarter', '2nd_quarter', '3rd_quarter', '4th_quarter', 'overall_grade']); // Specify the fields you need

        // Check if there are any approved grades
        $gradesApproved = $grades->isNotEmpty();

        return view('studentgrades', [
            'grades' => $grades, // Pass the collection of approved grades
            'gradesApproved' => $gradesApproved,
        ]);
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
        $userId = Auth::id();
        $assign = assign::findOrFail($userId);

        $student = register_form::findOrFail($assign->class_id);


        $fullName = "{$student->firstname} {$student->middlename} {$student->lastname}";

        return view('gradesubmit', [
            'assign' => $assign,
            'edpcode' => $assign->edpcode,
            'subject' => $assign->subject,
            'section' => $assign->section,
            'fullName' => $fullName,
        ]);
    }
    public function teacherattendance()
    {
        return view('teacherattendance');
    }
    public function teachercorevalue()
    {
        $assign = assign::findOrFail('class_id');

        $student = grade::where('grade_id', $assign->class_id);

        return view('teachercorevalue', [
            'student' => $student,
            'assign' => $assign
        ]);
    }

    //principal
    public function principal()
    {
        return view('principal');
    }

    public function principalclassload()
    {
        $section = section::all();
        $class = classes::all();
        $teachers = teacher::all();
        return view('principalclassload', compact('class', 'teachers', 'section'));
    }

    public function submittedgrades()
    {
        $assigns = assign::all();
        $grades = grade::all();

        $data = [
            'title' => 'Submitted Grades',
            'assigns' => $assigns,
            'grades' => $grades
        ];

        return view('submittedgrades', $data);
    }

    public function publishgrade()
    {
        return view('publishgrade');
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
        // Count pending and approved accounts
        $pendingCount = register_form::where('status', 'pending')->count();
        $approvedCount = register_form::where('status', 'approved')->count();

        // Fetch student information
        $students = studentdetails::all(); // You can adjust this to filter or paginate if needed

        return view('record', compact('students', 'pendingCount', 'approvedCount'));
    }
    public function studententries()
    {

        $studentDetails = studentdetails::all();
        $previousSchools = previous_school::all();
        $addresses = address::all();
        $requiredDocs = required_docs::all();

        // Pass all datasets to the view
        return view('studententries', compact('studentDetails', 'previousSchools', 'addresses', 'requiredDocs'));
    }
    public function showdetails()
    {
        return view('showdetails');
    }
    public function studentapplicant()
    {

        $account = register_form::where('status', register_form::STATUS_PENDING)->get();

        return view('studentapplicant', compact('account'));
    }

    public function approvedaccount()
    {
        // Fetch only approved accounts
        $account = register_form::where('status', 'approved')->get();

        return view('approvedaccount', compact('account'));
    }
    public function  recordapproval()
    {
        $account = register_form::all();

        return view(' recordapproval', compact('account'));
    }


    //cashier 
    public function cashier()
    {
        // Count pending and approved accounts
        $pendingCount = payment_form::where('status', 'pending')->count();
        $approvedCount = payment_form::where('status', 'approved')->count();

        // Fetch student information
        $students = studentdetails::all(); // You can adjust this to filter or paginate if needed

        return view('cashier', compact('students', 'pendingCount', 'approvedCount'));
    }
    public function cashieraddfee()
    {
        return view('cashieraddfee');
    }
    public function cashierstudentfee()
{
    // Fetch all students
    $students = register_form::all();
    
    // Fetch all payments
    $payments = payment_form::all();

    // Pass both students and payments to the view
    return view('cashierstudentfee', [
        'students' => $students,
        'payments' => $payments,
    ]);
}
public function approvedpayment()
{
    $students = register_form::where('status', 'approved')->get();
    $payments = payment_form::where('status', 'approved')->get();

    return view('approvedpayment', compact('students', 'payments'));
}

    public function sectioning()
    {
        $students = register_form::all();
        $payments = payment_form::all();

        return view('sectioning', [
            'students' => $students,
            'payments' => $payments,
        ]);
    }

    public function assigning()
    {
        $students = register_form::all();
        $payments = payment_form::all();
        $classes = classes::all();

        return view('assigning', [
            'students' => $students,
            'payments' => $payments,
            'classes' => $classes
        ]);
    }

    public function section()
    {
        $students = register_form::all();
        $payments = payment_form::all();
        $classes = classes::all();

        return view('section', [
            'students' => $students,
            'payments' => $payments,
            'classes' => $classes
        ]);
    }

    public function proofofpayment()
    {
        $students = register_form::all();
        $payments = payment_form::all();

        return view('cashierstudentfee', [
            'students' => $students,
            'payments' => $payments,
        ]);
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
    public function principalteacher()
    {
        return view('principalteacher');
    }

    public function createsection()
    {
        return view('createsection');
    }
}
