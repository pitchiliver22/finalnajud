<?php

namespace App\Http\Controllers;

use App\Models\address;
use App\Models\assessment;
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
use App\Http\Controllers\showAssessment;
use App\Mail\PublishAssessment;
use App\Models\attendance;
use Illuminate\Support\Facades\Mail as FacadesMail;

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
        $registerForm = register_form::findOrFail($registerFormId);

        $details = required_docs::where('required_id', $registerFormId)->get();

        return view('required_documents', compact('registerForm', 'details'));
    }

    public function payment_process($registerFormId)
    {
        $registerForm = register_form::findOrFail($registerFormId);

        $details = payment_form::where('payment_id', $registerFormId)->get();
    
        return view('payment_process', compact('registerForm', 'details'));
    }


    public function updatedetails($id)
    {
        
        $details = \App\Models\studentdetails::where('details_id', $id)->first();
    
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

        $proof = payment_form::where('payment_id', $student->id)->first(); 
    
        $data = [
            'title' => 'Student Payment',
            'account' => $student,
            'proof' => $proof
        ];
        return view('studentapplicant', $data);
    }

  

    public function sectioning($id)
    {
        $student = register_form::findOrFail($id);

        $proof = payment_form::where('payment_id', $student->id)->first(); 
    
        $data = [
            'title' => 'Student Payment',
            'account' => $student,
            'proof' => $proof
        ];
        return view('studentapplicant', $data);
    }

        public function assigning($id)
    {
        // Fetch the student using the register_form ID
        $student = register_form::findOrFail($id);
        
        // Log the student ID
        Log::info('Student ID:', [$student->id]);
        
        // Fetch the payment proof where payment_id matches the student's ID
        $proof = payment_form::where('payment_id', $student->id)->first(); 

        // Log the fetched payment proof
        Log::info('Fetched Payment Proof:', $proof ? [$proof->id] : ['Not found']);
        
        // Check if the payment proof exists
        if (!$proof) {
            return redirect('/sectioning')->with('error', 'Payment proof not found.');
        }

        // Fetch classes based on grade levels
        $classes = classes::whereIn('grade', [
            'kindergarten', 'Grade 1', 'Grade 2',
            'Grade 3', 'Grade 4', 'Grade 5',
            'Grade 6', 'Grade 7', 'Grade 8',
            'Grade 9', 'Grade 10'
        ])->get();

        // Prepare data for the view
        $data = [
            'title' => 'Assigning',
            'students' => $student,
            'proof' => $proof,
            'classes' => $classes,  
        ];

        return view('assigning', $data);
    }

    public function section($paymentId, $sectionName)
    {
        $proof = payment_form::where('payment_id', $paymentId)->firstOrFail(); 
    
        $students = register_form::where('id', $proof->payment_id)->firstOrFail(); 
    
        $classes = classes::where('grade', $proof->level)
            ->where('section', $sectionName)
            ->get();
    
        $data = [
            'title' => 'Assigning',
            'students' => $students,
            'proof' => $proof,
            'classes' => $classes,
            'sectionName' => $sectionName 
        ];
    
        return view('section', $data);
    }

    public function getSectionDetails($edpcode)
{
    $sectionDetails = classes::where('edpcode', $edpcode)->get(['edpcode', 'room', 'subject', 'description', 'type', 'unit', 'time', 'days']);

    return response()->json($sectionDetails);
}

    public function proofofpayment($id)
    {
        $proof = payment_form::find($id); 
        if (!$proof) {
            return redirect()->back()->with('error', 'Payment proof not found.');
        }
    
        $student = register_form::find($proof->payment_id);
        if (!$student) {
            return redirect()->back()->with('error', 'Student not found.');
        }
    
        return view('proofofpayment', compact('proof', 'student'));
    }

    public function studentprofile()
    {
        $userId = Auth::id();

        $profile = register_form::where('user_id', $userId)->firstOrFail();

        $level = payment_form::where('payment_id', $profile->id)->firstOrFail();

        $data = [
            'title' => 'Student Profile',
            'profile' => $profile,
            'level' => $level,
        ];

        return view('studentprofile', $data);
    }
     public function studenteditprofile(Request $request, $id)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'middlename' => 'nullable|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'level' => 'required|string|max:255',
        ]);
    
        $profile = register_form::findOrFail($id);
        $profile->firstname = $request->firstname;
        $profile->middlename = $request->middlename;
        $profile->lastname = $request->lastname;
        $profile->email = $request->email;
        $profile->save();
    
        // Update payment level if necessary
        // $level = payment_form::where('payment_id', $profile->id)->first();
        // $level->update(['level' => $request->level]);
    
        return redirect('/studenteditprofile')->with('success', 'Profile updated successfully.');
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

    public function teachercorevaluesubmit($teacher_id, $edp_code)
{
    // Fetch assignments based on the provided edp_code and teacher_id
    $assignments = Assign::where('edpcode', $edp_code)
                         ->where('teacher_id', $teacher_id)
                         ->get();

    $paymentForm = payment_form::where('payment_id', $teacher_id)->first();

    if ($assignments->isEmpty()) {
        return redirect()->back()->with('error', 'No assignments found for this teacher and EDP code.');
    }

    $classIds = $assignments->pluck('class_id')->unique();

    // Fetch students registered in those classes
    $students = register_form::whereIn('id', $classIds)->get();

    // Filter students based on assignments
    $studentsInSection = $students->filter(function($student) use ($assignments) {
        return $assignments->contains(function($assignment) use ($student) {
            return $assignment->class_id == $student->id;
        });
    });

    // Create a mapping of student IDs to class IDs
    $studentClassIds = $studentsInSection->keyBy('id')->map(function($student) use ($assignments) {
        $assignment = $assignments->firstWhere('class_id', $student->id);
        return $assignment ? $assignment->class_id : null;
    });

    // Create a detailed list of students with their core values information
    $studentsWithDetails = $studentsInSection->map(function($student) use ($assignments) {
        $assignment = $assignments->firstWhere('class_id', $student->id);
        return [
            'student' => $student, // Keep it as an object
            'edpcode' => $assignment ? $assignment->edpcode : null,
            'subject' => $assignment ? $assignment->subject : null,
            'section' => $assignment ? $assignment->section : null,
            'grade_level' => $assignment ? $assignment->grade : null,
        ];
    });

    $section = $assignments->first()->section ?? 'N/A';

    return view('teachercorevaluesubmit', [
        'students' => $studentsWithDetails,
        'paymentForm' => $paymentForm,
        'studentClassIds' => $studentClassIds,
        'edpcode' => $edp_code,
        'section' => $section,
    ]);
}

public function teacherAttendanceSubmit($teacher_id, $edp_code)
{
    // Fetch attendance records based on the provided edp_code and teacher_id
    $attendanceRecords = Assign::where('edpcode', $edp_code)
                               ->where('teacher_id', $teacher_id)
                               ->get();

    // Fetch the payment form for the teacher
    $paymentForm = payment_form::where('payment_id', $teacher_id)->first();

    // Check if attendance records exist
    if ($attendanceRecords->isEmpty()) {
        return redirect()->back()->with('error', 'No attendance records found for this teacher.');
    }

    // Get unique class IDs from attendance records
    $classIds = $attendanceRecords->pluck('class_id')->unique();

    // Fetch students registered in those classes
    $students = register_form::whereIn('id', $classIds)->get();

    // Filter students based on attendance records and edp_code
    $studentsInSection = $students->filter(function($student) use ($attendanceRecords, $edp_code) {
        return $attendanceRecords->contains(function($attendance) use ($student, $edp_code) {
            return $attendance->class_id == $student->id && $attendance->edpcode == $edp_code;
        });
    });

    // Create a mapping of student IDs to attendance records
    $studentClassIds = $studentsInSection->keyBy('id')->map(function($student) use ($attendanceRecords) {
        $attendance = $attendanceRecords->firstWhere('class_id', $student->id);
        return $attendance ? $attendance->class_id : null;
    });

    // Create a detailed list of students with their attendance information
    $studentsWithDetails = $studentsInSection->map(function($student) use ($attendanceRecords) {
        $attendance = $attendanceRecords->firstWhere('class_id', $student->id);
        return [
            'student' => $student,
            'edpcode' => $attendance ? $attendance->edpcode : null,
            'subject' => $attendance ? $attendance->subject : null,
            'section' => $attendance ? $attendance->section : null,
            'grade_level' => $attendance ? $attendance->grade : null,
        ];
    });

    // Return the view with the attendance details
    return view('teacherattendancesubmit', [
        'students' => $studentsWithDetails,
        'paymentForm' => $paymentForm,
        'studentClassIds' => $studentClassIds,
        'edpcode' => $edp_code, 
    ]);
}

public function publishgrade(Request $request)
{
    $edp_code = $request->input('edp_code');
    $subject = $request->input('subject');

    $grades = grade::where('subject', $subject)
        ->where('edp_code', $edp_code)
        ->where('status', 'pending')
        ->select('grade_id','fullname', 'section', 'subject', 'edp_code', 
                 '1st_quarter', '2nd_quarter', '3rd_quarter', '4th_quarter', 
                 'overall_grade', 'status')
        ->get();

    if ($grades->isEmpty()) {
        return redirect()->back()->with('error', 'No grades found for this subject and EDP code.');
    }

    return view('publishgrade', [
        'grades' => $grades,
        'edpcode' => $edp_code,
        'subject' => $subject,
    ]);
}

   


    public function gradesubmit($edp_code, $teacher_id)
    {
        $assignments = assign::where('edpcode', $edp_code)
                             ->where('teacher_id', $teacher_id)
                             ->get();
    
        if ($assignments->isEmpty()) {
            return redirect()->back()->with('error', 'No assignments found for this EDP code and teacher.');
        }
    
        $paymentForm = payment_form::where('payment_id', $teacher_id)->first();
        $quartersEnabled = QuarterSettings::first();
    
        $classIds = $assignments->pluck('class_id')->unique();
        $students = register_form::whereIn('id', $classIds)->get();
    
        $studentClassIds = $students->keyBy('id')->map(function($student) use ($assignments) {
            $assignment = $assignments->firstWhere('class_id', $student->id);
            return $assignment ? $assignment->class_id : null;
        });
    
        $subjects = $assignments->pluck('subject')->unique();
        $sections = $assignments->pluck('section')->unique();
    
        $fullNames = $students->map(function($student) {
            return "{$student->firstname} {$student->middlename} {$student->lastname}";
        })->toArray();
    
        $firstFullName = !empty($fullNames) ? $fullNames[0] : 'No student found';
    
        $importedGrades = session('importedGrades', []);
        return view('gradesubmit', [
            'assignments' => $assignments,
            'paymentForm' => $paymentForm,
            'students' => $students,
            'studentClassIds' => $studentClassIds, 
            'edpcode' => $edp_code,
            'subject' => $subjects->first(),
            'section' => $sections->first(),
            'firstFullName' => $firstFullName,
            'quartersEnabled' => [
                '1st_quarter' => $quartersEnabled->first_quarter_enabled ?? false,
                '2nd_quarter' => $quartersEnabled->second_quarter_enabled ?? false,
                '3rd_quarter' => $quartersEnabled->third_quarter_enabled ?? false,
                '4th_quarter' => $quartersEnabled->fourth_quarter_enabled ?? false,
            ],
            'importedGrades' => $importedGrades, 
        ]);
    }

    
    public function submittedgrades()
    {
        return view('submittedgrades');
    }


    public function principaleditassessment($id)
    {
        $assessment = assessment::findOrFail($id);

        $assessment->assessment_time = date('H:i', strtotime($assessment->assessment_time));

        return view('principaleditassessment', compact('assessment'));  
    }

    

    public function showStudentDetails($id)
    {
        $student = studentdetails::findOrFail($id);

        $address = address::where('address_id', $id)->first(); // Assuming 'student_id' links the address
        $previous = previous_school::where('school_id', $id)->first(); // Assuming 'student_id' links previous school
        $require = required_docs::where('required_id', $id)->get(); // Assuming this returns multiple documents

        return view('showdetails', compact('student', 'previous', 'require', 'address'));
    }

  

    public function getSubject($teacherId)
{
    $teacher = teacher::find($teacherId);
    if ($teacher) {
        $subjects = array_map('trim', explode(',', $teacher->subject)); 
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
    
    $teachers = teacher::where('subject', 'like', '%' . $subject . '%')->get(); 

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
    $teachers = teacher::where('grade', $grade)->get(['user_id', 'name', 'subject']);

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

public function publishAssessment($id)
{
    // Logic to publish the assessment
    $assessment = assessment::findOrFail($id);
    $assessment->status = 'Published'; // Example status change
    $assessment->save();

    FacadesMail::to('accounting@example.com')->send(new PublishAssessment($assessment));

    return redirect()->back()->with('success', 'Assessment published successfully.');
}

public function accountingprofile($id)
{
    $user = Auth::user();

    return view('accountingprofile', $user);
}

public function editAssessment($id)
{
    // Logic to show the edit form for the assessment
    $assessment = assessment::findOrFail($id);
    return view('editassessment', compact('assessment')); // Adjust view name accordingly
}

public function deleteAssessment($id)
{
    // Logic to delete the assessment
    $assessment = assessment::findOrFail($id);
    $assessment->delete();

    return redirect()->back()->with('success', 'Assessment deleted successfully.');
}


    public function oldstudentaddress($registerFormId)
    {
        $registerForm = register_form::findOrFail($registerFormId);

        $addresses = address::where('address_id', $registerFormId)->get();

        return view('oldstudentaddress', compact('registerForm', 'addresses'));
    }

    public function oldstudentupdatedetails($id)
    {
        $details = \App\Models\studentdetails::where('details_id', $id)->first();
    
        if (!$details) {
            return redirect('/oldstudentenrollment')->with('error', 'Student details not found.');
        }
        return view('oldstudentupdatedetails', compact('details'));
    }

    public function oldstudentupdateaddress($id)
    {
        $address = \App\Models\address::where('address_id', $id)->first();

        if (!$address) {
            return redirect('/oldstudentenrollment')->with('error', 'address not found.');
        }
        return view('oldstudentupdateaddress', compact('address'));
    }

    public function oldstudentupdateprevious($id)
    {
        $school = \App\Models\previous_school::where('school_id', $id)->first();

        if (!$school) {
            return redirect('/oldstudentenrollment')->with('error', 'Previous school details not found.');
        }
    
        $userId = Auth::user()->id;  
        $registerForm = \App\Models\register_form::where('user_id', $userId)->first();  
    
        return view('oldstudentupdateprevious', compact('school', 'registerForm'));
    }


}
