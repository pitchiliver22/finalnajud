<?php

namespace App\Http\Controllers;

use App\Models\address;
use App\Models\assign;
use App\Models\classes;
use App\Models\grade;
use App\Models\payment_form;
use App\Models\previous_school;
use App\Models\QuarterSettings;
use App\Models\register_form;
use App\Models\required_docs;
use App\Models\section;
use App\Models\studentdetails;
use App\Models\teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use tidy;

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

    public function studentdetails($registerFormId)
    {
        $registerForm = register_form::findOrFail($registerFormId);
    
        $details = studentdetails::where('details_id', $registerFormId)->get();
    
         return view('studentdetails', compact('registerForm', 'details'));
    }

    public function address_contact($registerFormId)
    {
   
    $registerForm = register_form::findOrFail($registerFormId);
    
    $addresses = address::where('address_id', $registerFormId)->get();
    

    return view('address_contact', compact('registerForm', 'addresses'));
    }

    public function previous_school($registerFormId)
    {
        $registerForm = register_form::findOrFail($registerFormId);
    
        $details = previous_school::where('school_id', $registerFormId)->get();

     return view('previous_school', compact('registerForm', 'details'));
    }

    public function required_documents($registerFormId)
    {
                   // Fetch the corresponding register_form record using the provided ID
        $registerForm = register_form::findOrFail($registerFormId);
    
            // Fetch existing student details linked to this register_form
        $details = required_docs::where('required_id', $registerFormId)->get();
    
        // Pass both the register form and details to the view
        return view('required_documents', compact('registerForm', 'details'));
    }

    public function payment_process($registerFormId)
    {
                   // Fetch the corresponding register_form record using the provided ID
        $registerForm = register_form::findOrFail($registerFormId);
    
            // Fetch existing student details linked to this register_form
        $details = payment_form::where('payment_id', $registerFormId)->get();
    
        // Pass both the register form and details to the view
        return view('payment_process', compact('registerForm', 'details'));
    }


    public function updatedetails($id)
    {
        
        $details = \App\Models\studentdetails::find($id);
    
        if (!$details) {
            return redirect('/enrollmentstep')->with('error', 'Student details not found.');
        }
    
        return view('updatedetails', compact('details'));
    }

    public function updateaddress($id)
    {

        $address = \App\Models\address::where('address_id', $id)->first();

        if (!$address) {
            return redirect('/enrollmentstep')->with('error', 'address not found.');
        }
        return view('updateaddress', compact('address'));
    }
    public function updatedocuments($id)
    {
        $docRecord = \App\Models\required_docs::where('required_id', $id)->first();

        if (!$docRecord) {
            return redirect('/enrollmentstep')->with('error', 'Student details not found.');
        }
          $docs = required_docs::where('required_id', $docRecord->required_id)->get();

          $userId = Auth::user()->id;
          $registerForm = \App\Models\register_form::where('user_id', $userId)->first();
      
          return view('updatedocuments', compact('docs', 'registerForm'));
    }

    public function updateschool($id)
    {
        $school = \App\Models\previous_school::where('school_id', $id)->first();
    
        if (!$school) {
            return redirect('/enrollmentstep')->with('error', 'School details not found.');
        }
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

    public function section($id, $sectionName)
{
    $students = register_form::findOrFail($id);
    $proof = payment_form::where('id', $id)->firstOrFail(); // Adjust if necessary

    $classes = classes::where('grade', $proof->level)
        ->where('section', $sectionName)
        ->get();

    $data = [
        'title' => 'Assigning',
        'students' => $students,
        'proof' => $proof,
        'classes' => $classes,
        'sectionName' => $sectionName // Pass section name for the view
    ];

    return view('section', $data);
}
    public function getSectionDetails($edpcode)
{
    // Fetch the class details for the specific edpcode
    $sectionDetails = classes::where('edpcode', $edpcode)->get(['edpcode', 'room', 'subject', 'description', 'type', 'unit', 'time', 'days']);

    return response()->json($sectionDetails);
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
    $user = Auth::user(); // Get the authenticated user
    $fullName = trim("{$user->firstname} {$user->middlename} {$user->lastname}"); // Create the full name

    // Get all classes from the 'assign' table
    $classes = assign::where('adviser', $fullName)->get(); // Fetch classes where adviser matches full name

    // Get all payment records from the 'payment_form' table
    $proofs = payment_form::whereNotNull('level')->get(); // Fetch all records with a level

    return view('teacherclassload', [
        'title' => 'Teacher Class Load',
        'classes' => $classes,
        'proofs' => $proofs // Pass all proofs to the view
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
        $assign = Assign::findOrFail($id);
        $paymentForm = payment_form::where('payment_id', $assign->class_id)->first();
        $student = register_form::findOrFail($assign->class_id);
        
        // Fetch the full name of the student
        $fullName = "{$student->firstname} {$student->middlename} {$student->lastname}";
        
        // Fetch the grade if it exists
        $grade = grade::where('grade_id', $assign->id)->first();
        
        // Fetch the latest quarter settings
        $quartersEnabled = QuarterSettings::first();
        
        // Prepare the quarters enabled array
        $quartersEnabledArray = [
            '1st_quarter' => $quartersEnabled->first_quarter_enabled ?? false,
            '2nd_quarter' => $quartersEnabled->second_quarter_enabled ?? false,
            '3rd_quarter' => $quartersEnabled->third_quarter_enabled ?? false,
            '4th_quarter' => $quartersEnabled->fourth_quarter_enabled ?? false,
        ];
    
        // Prepare the quarters status array
        $quartersStatusArray = [
            '1st_quarter' => $quartersEnabled->first_quarter_status ?? 'inactive',
            '2nd_quarter' => $quartersEnabled->second_quarter_status ?? 'inactive',
            '3rd_quarter' => $quartersEnabled->third_quarter_status ?? 'inactive',
            '4th_quarter' => $quartersEnabled->fourth_quarter_status ?? 'inactive',
        ];
        
        return view('gradesubmit', [
            'assign' => $assign,
            'paymentForm' => $paymentForm,
            'fullName' => $fullName,
            'edpcode' => $assign->edpcode,
            'subject' => $assign->subject,
            'section' => $assign->section,
            'grade' => $grade,
            'quartersEnabled' => $quartersEnabledArray,
            'quartersStatus' => $quartersStatusArray, // Pass the status array to the view
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
    $teacher = teacher::find($teacherId);

    if ($teacher) {
        // Split the subjects by comma and trim whitespace
        $subjects = array_map('trim', explode(',', $teacher->subject)); // Assuming 'subject' is a comma-separated string
        return response()->json([
            'subjects' => $subjects,
        ]);
    }

    return response()->json([
        'subjects' => [],
    ]);
}

public function getAssignedTeacher($subject)
{
    
    $teachers = teacher::where('subject', 'like', '%' . $subject . '%')->get(); // Adjust this as needed

    if ($teachers->isNotEmpty()) {
        $teacherList = $teachers->map(function($teacher) {
            return [
                'id' => $teacher->id,
                'name' => $teacher->name,
            ];
        });

        return response()->json([
            'teachers' => $teacherList,
        ]);
    }

    return response()->json(['teachers' => null]);
}

public function getTeachersByGrade($grade) {
    $teachers = teacher::where('grade', $grade)->get(['id', 'name', 'subject']);

    return response()->json([
        'teachers' => $teachers
    ]);
}

public function getTeachersBySubjectAndGrade(Request $request)
{
    $selectedSubject = $request->input('subject');
    $selectedGrade = $request->input('grade');

    $teachers = teacher::where('grade', $selectedGrade)
        ->where('subject', 'LIKE', '%' . $selectedSubject . '%')
        ->get(['id', 'name']);

    return response()->json($teachers);
}

public function deleteSection($id)
{
    $section = section::findOrFail($id);
    $section->delete();

    return redirect()->back()->with('success', 'Section deleted successfully.');
}
}
