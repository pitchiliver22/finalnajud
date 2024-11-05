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
use App\Models\studentdetails;
use App\Models\teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class Usercontroller extends Controller
{

    public function studentapplicant($id)
    {
        $account = register_form::findOrFail($id);
        $data = [
            'title' => 'Student Account ',
            'account' => $account
        ];
        return view('studentapplicant', $data);
    }

    public function approvedaccount($id)
    {
        $account = register_form::findOrFail($id);
        $data = [
            'title' => 'Student Account ',
            'account' => $account
        ];
        return view('approvedaccount', $data);
    }

    public function recordapproval($id)
    {
        $account = register_form::findOrFail($id);

        return view('recordapproval', compact('account'));
    }



    public function updatedetails($id)
    {

        $details = studentdetails::findOrFail($id);

        return view('updatedetails', compact('details'));
    }

    public function updateaddress($id)
    {

        $address = address::findOrFail($id);

        return view('updateaddress', compact('address'));
    }
    public function updatedocuments($id)
    {
        // Fetch the required document record
        $docRecord = required_docs::findOrFail($id);

        // Fetch all documents associated with the required_id
        $docs = required_docs::where('required_id', $docRecord->required_id)->get();

        return view('updatedocuments', compact('docs'));
    }
    public function updateschool($id)
    {

        $school = previous_school::findOrFail($id);

        return view('updateschool', compact('school'));
    }

    public function cashierstudentfee($id)
    {
        $student = register_form::findOrFail($id);
        $proof = payment_form::findOrFail($id);
        $data = [
            'title' => 'Student Payment ',
            'account' => $student,
            'proof' => $proof
        ];
        return view('studentapplicant', $data);
    }

    public function sectioning($id)
    {
        $student = register_form::findOrFail($id);
        $proof = payment_form::findOrFail($id);
        $data = [
            'title' => 'Sectioning ',
            'account' => $student,
            'proof' => $proof
        ];
        return view('sectioning', $data);
    }

    public function assigning($id)
    {
        $students = register_form::findOrFail($id);
        $proof = payment_form::findOrFail($id);

        $classes = classes::whereIn('grade', [
            'kindergarten',
            'Grade 1',
            'Grade 2',
            'Grade 3',
            'Grade 4',
            'Grade 5',
            'Grade 6',
            'Grade 7',
            'Grade 8',
            'Grade 9',
            'Grade 10'
        ])->get();

        $data = [
            'title' => 'Assigning',
            'students' => $students,
            'proof' => $proof,
            'classes' => $classes,
        ];

        return view('assigning', $data);
    }
    public function proofofpayment($id)
    {
        $proof = payment_form::findOrFail($id);
        $student = register_form::findOrFail($proof->payment_id);

        return view('proofofpayment', compact('proof', 'student'));
    }

    public function studentprofile()
    {
        $userId = Auth::id();

        $profile = register_form::where('id', $userId)->firstOrFail();

        $level = payment_form::where('payment_id', $userId)->firstOrFail();

        $data = [
            'title' => 'Student Profile',
            'profile' => $profile,
            'level' => $level,
        ];

        return view('studentprofile', $data);
    }




    public function delete_class($id)
    {
        classes::where('id', $id)->delete();
        return redirect('/principalclassload')->with('success', 'Deleted class load successfully.');
    }

    public function update_class($id)
    {
        $classes = classes::findOrFail($id);
        return view('update_class', compact('classes'));
    }
    public function teacherclassload()
    {
        $userId = Auth::id();

        $classes = assign::all();
        $proof = payment_form::where('payment_id', $userId)->firstOrFail();

        return view('teacherclassload', [
            'title' => 'Teacher Class Load',
            'classes' => $classes,
            'proof' => $proof
        ]);
    }

    public function publishgrade($id)
    {
        $assign = assign::findOrFail($id);

        $grades = grade::find($id);
        if (!$grades) {
            return view('publishgrade', [
                'grades' => null,
                'assign' => $assign,
                'paymentForm' => null,
                'fullName' => null,
                'edpcode' => $assign->edpcode,
                'subject' => $assign->subject,
                'first_quarter' => 'N/A',
                'second_quarter' => 'N/A',
                'third_quarter' => 'N/A',
                'fourth_quarter' => 'N/A',
                'overall_grade' => 'N/A',
                'status' => 'N/A',
            ]);
        }

        $paymentForm = Payment_form::where('payment_id', $assign->class_id)->first();

        $student = Register_form::findOrFail($assign->class_id);

        $fullName = "{$student->firstname} {$student->middlename} {$student->lastname}";

        return view('publishgrade', [
            'grades' => $grades,
            'assign' => $assign,
            'paymentForm' => $paymentForm,
            'fullName' => $fullName,
            'edpcode' => $assign->edpcode,
            'subject' => $assign->subject,
            'first_quarter' => $grades->{"1st_quarter"} ?? 'N/A', // Access using curly braces for special characters
            'second_quarter' => $grades->{"2nd_quarter"} ?? 'N/A',
            'third_quarter' => $grades->{"3rd_quarter"} ?? 'N/A',
            'fourth_quarter' => $grades->{"4th_quarter"} ?? 'N/A',
            'overall_grade' => $grades->overall_grade ?? 'N/A',
            'status' => $grades->status ?? 'N/A',
        ]);
    }

    public function publish($id)
    {

        $grades = grade::findOrFail($id);


        $grades->status = 'approved';
        $grades->save();


        return redirect()->route('grades.publish', $id)->with('success', 'Grade status updated to approved.');
    }

    public function gradesubmit($id)
    {

        $assign = assign::findOrFail($id);


        $paymentForm = Payment_form::where('payment_id', $assign->class_id)->first();

        $student = Register_form::findOrFail($assign->class_id); // Assuming student_id is a foreign key in assign table


        $fullName = "{$student->firstname} {$student->middlename} {$student->lastname}";

        return view('gradesubmit', [
            'assign' => $assign,
            'paymentForm' => $paymentForm,
            'fullName' => $fullName,
            'edpcode' => $assign->edpcode, // Assuming this is how you access the EDP code
            'subject' => $assign->subject, // Assuming this is how you access the subject
            'section' => $assign->section
        ]);
    }

    public function studentClassLoad()
    {
        $userId = Auth::id();

        $assignedClasses = assign::where('class_id', $userId)->get();

        $student = register_form::find($userId);
        if (!$student) {
            return redirect()->back()->withErrors('Student not found.');
        }

        $proof = payment_form::where('payment_id', $userId)->first();

        return view('studentclassload', [
            'assignedClasses' => $assignedClasses,
            'student' => $student,
            'proof' => $proof,
        ]);
    }

    public function submittedgrades()
    {
        return view('submittedgrades');
    }

    public function teachercorevalue() {}






    public function showStudentDetails($id)
    {
        // Fetch the student details
        $student = studentdetails::findOrFail($id);

        // Fetch related data using the student's ID
        $address = address::where('address_id', $id)->first(); // Assuming 'student_id' links the address
        $previous = previous_school::where('school_id', $id)->first(); // Assuming 'student_id' links previous school
        $require = required_docs::where('required_id', $id)->get(); // Assuming this returns multiple documents

        return view('showdetails', compact('student', 'previous', 'require', 'address'));
    }

    public function getSubject($teacherId)
    {
        // Fetch the teacher by ID
        $teacher = Teacher::find($teacherId);

        if ($teacher) {
            // Split the subjects by comma and trim whitespace
            $subjects = array_map('trim', explode(',', $teacher->subject));
            return response()->json([
                'subjects' => $subjects,
            ]);
        }

        return response()->json([
            'subjects' => [],
        ]);
    }
}
