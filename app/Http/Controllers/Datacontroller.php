<?php

namespace App\Http\Controllers;

use App\Mail\ApprovePayment;
use App\Models\address;
use App\Models\assign;
use App\Models\classes;
use App\Models\corevalues;
use App\Models\grade;
use App\Models\previous_primary;
use App\Models\previous_school;
use App\Models\previous_secondary;
use App\Models\register_form;
use App\Models\required_docs;
use App\Models\studentdetails;
use App\Models\User;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use App\Models\payment_form;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\NullableType;
use App\Mail\ApproveStudent;
use App\Mail\PendingPayment;
use App\Mail\PendingStudent;
use App\Models\subject;
use App\Models\teacher;
use Illuminate\Support\Facades\Mail as FacadesMail;

class Datacontroller extends Controller
{

    public function partialaccountpost(Request $request)
    {

        $validateData = $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'middlename' => 'required',
            'suffix' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        FacadesMail::to($validateData['email'])->send(new PendingStudent($validateData));

        $validateData['status'] = 'pending';
        register_form::create($validateData);
        return redirect('/login');
    }


    public function loginPost(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        // Define default credentials
        $defaultCredentials = [
            'Teacher' => ['email' => 'teacher@example.com', 'password' => 'teacher123'],
            'Principal' => ['email' => 'principal@example.com', 'password' => 'principal123'],
            'Cashier' => ['email' => 'cashier@example.com', 'password' => 'cashier123'],
            'Record' => ['email' => 'record@example.com', 'password' => 'record123'],
            'Accounting' => ['email' => 'accounting@example.com', 'password' => 'accounting123'],
        ];

        // Check for default credentials
        foreach ($defaultCredentials as $role => $default) {
            if ($credentials['email'] === $default['email'] && $credentials['password'] === $default['password']) {
                // Create a user instance with the role
                $user = User::where('email', $default['email'])->first();
                if ($user) {
                    Auth::login($user); // Log in the user
                    sweetalert()->success("Welcome {$role}!");
                    return redirect(strtolower($role))->with('success', "Welcome, {$role}!");
                }
            }
        }

        // Attempt to log in with provided credentials
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Handle non-default roles
            switch ($user->role) {
                case 'Teacher':
                    sweetalert()->success('Welcome Teacher!');
                    return redirect('/teacher')->with('success', 'Welcome, Teacher!');

                case 'Newstudent':
                    sweetalert()->success('Welcome New Student!');
                    return redirect('/studentdetails')->with('success', 'Welcome, New Student!');

                case 'Oldstudent':
                    // sweetalert()->success('Welcome Old Student!');
                    return redirect('/studentdashboard')->with('success', 'Welcome, Student!');

                case 'Record':
                    sweetalert()->success('Welcome Records!');
                    return redirect('/record')->with('success', 'Welcome, Record!');

                case 'Cashier':
                    sweetalert()->success('Welcome Cashier!');
                    return redirect('/cashier')->with('success', 'Welcome, Cashier!');

                case 'Principal':
                    sweetalert()->success('Welcome Principal!');
                    return redirect('/principal')->with('success', 'Welcome, Principal!');

                case 'Accounting':
                    sweetalert()->success('Welcome Accounting!');
                    return redirect('/accounting')->with('success', 'Welcome, Accounting!');

                default:
                    return back()->with('error', 'Invalid user role.');
            }
        }

        sweetalert()->warning('Pending approval account.');
        return back()->withErrors([
            'email' => 'The provided email is incorrect.',
            'password' => 'The provided password is incorrect.',
        ])->onlyInput('email');
    }


    public function adminuserspost(Request $request)
    {

        $validateData = $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'middlename' => 'required',
            'suffix' => 'required',
            'role' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        User::create($validateData);
        return redirect('/adminusers');
    }

    public function studentdetailspost(Request $request)
    {

        $validateData = $request->validate([
            'firstname' => 'required',
            'middlename' => 'required',
            'lastname' => 'required',
            'suffix' => 'required',
            'nationality' => 'required',
            'gender' => 'required',
            'civilstatus' => 'required',
            'birthdate' => 'required',
            'birthplace' => 'required',
            'religion' => 'required',
            'mother_name' => 'required',
            'mother_occupation' => 'required',
            'mother_contact' => 'required',
            'father_name' => 'required',
            'father_occupation' => 'required',
            'father_contact' => 'required',
            'guardian_name' => 'required',
            'guardian_occupation' => 'required',
            'guardian_contact' => 'required',
            'details_id' => 'required',
        ]);

        $validatedData['status'] = 'pending';

        studentdetails::create($validateData);
        return redirect('/address_contact')->with('success', 'Student details submitted successfully.');
    }

    public function address_contactpost(Request $request)
    {
        $validateData = $request->validate([
            'zipcode' => 'required',
            'province' => 'required',
            'city' => 'required',
            'barangay' => 'required',
            'streetaddress' => 'required',
            'address_id' => 'required',
        ]);

        $validatedData['status'] = 'pending';

        address::create($validateData);
        return redirect('/previous_school')->with('success', 'Address and contact submitted successfully.');
    }

    public function recordapprovalpost(Request $request)
    {
        $validateData = $request->validate([
            'id' => 'required|exists:register_form,id', // Ensure the record exists
            'firstname' => 'required',
            'lastname' => 'required',
            'middlename' => 'required',
            'suffix' => 'required',
            'role' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ]);

        // Create the user
        $user = User::create([
            'firstname' => $validateData['firstname'],
            'lastname' => $validateData['lastname'],
            'middlename' => $validateData['middlename'],
            'suffix' => $validateData['suffix'],
            'role' => $validateData['role'],
            'email' => $validateData['email'], // Fetching email from user input
            'password' => $validateData['password'], // Store plain text password 
        ]);

        FacadesMail::to($user->email)->send(new ApproveStudent($user));

        // Update the register_form status to approved
        $registerForm = register_form::findOrFail($validateData['id']);
        $registerForm->status = register_form::STATUS_APPROVED;
        $registerForm->save();

        sweetalert()->success('You have approved the student and created a user!');
        return redirect('/studentapplicant'); // Redirect to the list of applicants
    }

    public function previous_schoolpost(Request $request)
    {
        $validateData = $request->validate([
            'second_school_name' => 'required',
            'second_last_year_level' => 'required',
            'second_school_year_from' => 'required|digits:4|integer|min:1900|max:2100',
            'second_school_year_to' => 'required|digits:4|integer|min:1900|max:2100|gte:second_school_year_from',
            'second_school_type' => 'required',

            'primary_school_name' => 'required',
            'primary_last_year_level' => 'required',
            'primary_school_year_from' => 'required|digits:4|integer|min:1900|max:2100',
            'primary_school_year_to' => 'required|digits:4|integer|min:1900|max:2100|gte:primary_school_year_from',
            'primary_school_type' => 'required',

            'school_id' => 'required',
        ]);

        $validatedData['status'] = 'pending';

        previous_school::create($validateData);

        return redirect('/required_documents')->with('success', 'Previous school details submitted successfully!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login')->with('success', 'You have been logged out.');
    }

    public function required_documents_post(Request $request)
    {
        $validateData = $request->validate([
            'type' => 'required|array',
            'type.*' => 'string|distinct', // Ensure that each type is unique
            'documents' => 'required|array',
            'documents.*' => 'file|max:10240|mimes:jpg,png,pdf',
            'required_id' => 'required',
        ]);

        $validatedData['status'] = 'pending';

        $uploadedTypes = []; // Track uploaded types

        foreach ($request->file('documents') as $index => $file) {
            $docType = $validateData['type'][$index];

            // Check if this type has already been uploaded
            if (in_array($docType, $uploadedTypes)) {
                continue; // Skip if already uploaded
            }

            $filePath = $file->store('documents', 'public');

            required_docs::create([
                'type' => $docType,
                'documents' => $filePath,
                'required_id' => $validateData['required_id'],
            ]);

            $uploadedTypes[] = $docType;
        }

        return redirect('/payment_process')->with('success', 'Required documents uploaded successfully!');
    }

    public function payment_processpost(Request $request)
    {
        $request->validate([
            'payment-proof' => 'required|image|mimes:jpg,jpeg,png,bmp|max:2048',
            'level' => 'required|string',
            'payment-details' => 'required|string|max:1000',
            'payment_id' => 'required|integer',
        ]);

        if ($request->hasFile('payment-proof')) {
            $file = $request->file('payment-proof');
            $filePath = $file->store('payment_proofs', 'public');

            // Define the amount and fee type here
            $amount = 500;  // Example amount, adjust as needed
            $feeType = 'Enrollment Fee';  // Example fee type, adjust as needed

            $payment = new payment_form();
            $payment->fee_type = $feeType;
            $payment->amount = $amount;
            $payment->payment_proof = $filePath;
            $payment->payment_details = $request->input('payment-details');
            $payment->payment_id = $request->input('payment_id');
            $payment->level = $request->input('level');
            $payment->save();

            $user = Auth::user();
            if ($user instanceof User) {
                $user->role = 'Oldstudent';
                $user->save();

                // Sending email with user data, amount, and fee type
                FacadesMail::to($user->email)->send(new PendingPayment($user->toArray(), $amount, $feeType));
            }
        }
        return redirect('/enrollmentstep')->with('success', 'Payment submitted successfully!');
    }

    public function updatedetailspost(Request $request)
    {
        // Validate the incoming request data
        $validateData = $request->validate([
            'firstname' => 'required',
            'middlename' => 'required',
            'lastname' => 'required',
            'suffix' => 'required',
            'nationality' => 'required',
            'gender' => 'required',
            'civilstatus' => 'required',
            'birthdate' => 'required',
            'birthplace' => 'required',
            'religion' => 'required',
            'mother_name' => 'required',
            'mother_occupation' => 'required',
            'mother_contact' => 'required',
            'father_name' => 'required',
            'father_occupation' => 'required',
            'father_contact' => 'required',
            'guardian_name' => 'required',
            'guardian_occupation' => 'required',
            'guardian_contact' => 'required',
            'details_id' => 'required|exists:studentdetails,id',
        ]);

        // Find the student details by ID
        $studentDetail = studentdetails::find($request->details_id);

        if ($studentDetail) {
            // Update the student details
            $studentDetail->update($validateData);

            // Update the status to 'approved'
            $studentDetail->status = 'approved';
            $studentDetail->save();

            // Redirect with a success message
            return redirect()->route('enrollment.step')->with('success', 'Student details updated successfully.');
        } else {
            return redirect()->route('enrollment.step')->withErrors('Student details not found.');
        }
    }

    public function updateaddresspost(Request $request)
    {
        $validateData = $request->validate([
            'zipcode' => 'required',
            'province' => 'required',
            'city' => 'required',
            'barangay' => 'required',
            'streetaddress' => 'required',
            'address_id' => 'required|exists:address,id',
        ]);

        $address = address::find($request->address_id);

        if ($address) {
            // Update the student details
            $address->update($validateData);

            // Update the status to 'approved'
            $address->status = 'approved';
            $address->save();

            // Redirect with a success message
            return redirect()->route('enrollment.step')->with('success', 'Address details updated successfully.');
        } else {
            return redirect()->route('enrollment.step')->withErrors('Address details not found.');
        }
    }

    public function updateschoolpost(Request $request)
    {
        $validateData = $request->validate([
            'second_school_name' => 'required',
            'second_last_year_level' => 'required',
            'second_school_year_from' => 'required',
            'second_school_year_to' => 'required',
            'second_school_type' => 'required',

            'primary_school_name' => 'required',
            'primary_last_year_level' => 'required',
            'primary_school_year_from' => 'required',
            'primary_school_year_to' => 'required',
            'primary_school_type' => 'required',

            'school_id' => 'required|exists:previous_school,id',
        ]);

        $previousSchool = previous_school::find($request->school_id);

        if ($previousSchool) {
            // Update the student details
            $previousSchool->update($validateData);

            // Update the status to 'approved'
            $previousSchool->status = 'approved';
            $previousSchool->save();

            // Redirect with a success message
            return redirect()->route('enrollment.step')->with('success', 'Previous school details updated successfully.');
        } else {
            return redirect()->route('enrollment.step')->withErrors('Previous school details not found.');
        }
    }


    public function updatedocumentspost(Request $request)
    {
        // Validate the request data
        $validateData = $request->validate([
            'type' => 'required|array',
            'type.*' => 'string|distinct',
            'documents' => 'nullable|array',
            'documents.*' => 'file|max:10240|mimes:jpg,png,pdf',
            'required_id' => 'required',
        ]);

        // Check if documents are uploaded
        if ($this->documentsUploaded($request)) {
            return $this->handleDocumentUpload($validateData);
        }

        return $this->approveExistingDocuments($validateData['required_id']);
    }

    private function documentsUploaded($request)
    {
        return $request->has('documents') && count($request->file('documents')) > 0;
    }

    private function handleDocumentUpload($validateData)
    {
        $uploadedTypes = [];

        foreach ($validateData['documents'] as $index => $file) {
            $docType = $validateData['type'][$index];

            // Skip if this document type has already been uploaded
            if (in_array($docType, $uploadedTypes)) {
                continue;
            }

            // Store the file and create a record in the database
            $filePath = $file->store('documents', 'public');

            // Create a new document record
            required_docs::create([
                'type' => $docType,
                'documents' => $filePath,
                'required_id' => $validateData['required_id'],
                'status' => 'approved', // Use a constant if you have one
            ]);

            $uploadedTypes[] = $docType; // Track uploaded types
        }

        return redirect()->route('enrollment.step')->with('success', 'Documents uploaded and approved successfully.');
    }

    private function approveExistingDocuments($requiredId)
    {
        $existingDocs = required_docs::where('required_id', $requiredId)->get();

        if ($existingDocs->isNotEmpty()) {
            foreach ($existingDocs as $doc) {
                $doc->update(['status' => 'approved']); // Use a constant if you have one
            }
            return redirect()->route('enrollment.step')->with('success', 'No new documents uploaded. Existing documents approved successfully.');
        }

        return redirect()->route('enrollment.step')->withErrors('No documents found for the required ID.');
    }

    public function enrollmentStep()
    {
        $payment_id = Auth::user()->payment_id;

        $details_id = Auth::user()->details_id;

        $address_id = Auth::user()->address_id;

        $school_id = Auth::user()->school_id;

        $required_id = Auth::user()->required_id;

        $paymentStatus = payment_form::where('payment_id', $payment_id)->value('status');
        $detailsStatus = studentdetails::where('details_id', $details_id)->value('status');
        $addressStatus = address::where('address_id', $address_id)->value('status');
        $previousStatus = previous_school::where('school_id', $school_id)->value('status');
        $requiredStatus = required_docs::where('required_id', $required_id)->value('status');

        return view('enrollmentstep', compact('detailsStatus', 'addressStatus', 'previousStatus', 'paymentStatus', 'requiredStatus'));
    }

    public function approvePayment($id)
    {
        $paymentForm = payment_form::where('payment_id', $id)->first();

        if (!$paymentForm) {
            return redirect('/cashierstudentfee')->with('error', 'Payment not found.');
        }

        if ($paymentForm->status === 'pending') {
            $paymentForm->status = 'approved';
            $paymentForm->save();
        }

        $user = Auth::user();
        if ($user instanceof User) {
            $user->role = 'Oldstudent';
            $user->save();
            FacadesMail::to($user->email)->send(new ApprovePayment($user->toArray()));
        }

        return redirect('/cashierstudentfee')->with('success', 'Payment approved successfully.');
    }

    //principal


    public function classloadpost(Request $request)
    {
        $validateData = $request->validate([
            'grade' => 'required',
            'adviser' => 'required',
            'section' => 'required',
            'edpcode' => 'required',
            'subject' => 'required',
            'room' => 'required',
            'description' => 'required',
            'type' => 'nullable|string',
            'unit' => 'required',
            'time' => 'required',
            'days' => 'required',
        ]);


        $validateData['adviser'] = strtoupper($validateData['adviser']);
        $validateData['section'] = strtoupper($validateData['section']);
        $validateData['room'] = strtoupper($validateData['room']);
        $validateData['subject'] = strtoupper($validateData['subject']);
        $validateData['days'] = strtoupper($validateData['days']);
        $validateData['time'] = strtoupper($validateData['time']);
        $validateData['status'] = 'not assigned';


        $conflict = classes::where('room', $validateData['room'])
            ->where('days', $validateData['days'])
            ->where('time', $validateData['time'])
            ->where('edpcode', $validateData['edpcode'])
            ->exists();

        if ($conflict) {
            return redirect('/principalclassload')->withErrors(['error' => 'Conflict detected: This edpcode is already assigned at this time, room, and on these days.']);
        }


        classes::create($validateData);
        return redirect('/principalclassload')->with('success', 'Classload added successfully');
    }
    public function update_class(Request $request, $id)
    {

        $class = classes::findOrFail($id);
        return view('update_class', compact('class'));
    }

    public function updateClass(Request $request, $id)
    {
        // Fetch the class or fail
        $classes = classes::findOrFail($id);

        // Validate the incoming request data
        $validatedData = $request->validate([
            'grade' => 'required',
            'section' => 'required',
            'edpcode' => 'required',
            'subject' => 'required',
            'room' => 'required',
            'description' => 'required',
            'type' => 'nullable|string',
            'unit' => 'required|integer|max:3', // Ensure unit is an integer and within limit
            'time' => 'required',
            'days' => 'required',
        ]);

        // Update the class with the validated data
        $classes->update($validatedData);

        // Redirect with a success message
        return redirect('/principalclassload')->with('success', 'Class load updated successfully.');
    }

    public function assigning(Request $request)
    {
        $request->validate([
            'selected_classes' => 'required|array',
            'selected_classes.*' => 'string',
            'grade' => 'required|string',
            'payment_id' => 'required|integer'
        ]);

        // Initialize a variable to track if any classes were assigned
        $anyAssigned = false;

        foreach ($request->selected_classes as $classEdpCode) {
            $class = classes::where('edpcode', $classEdpCode)->first();

            if ($class) {
                // Check for existing assignment based on edpcode
                $existingAssignment = assign::where('edpcode', $class->edpcode)
                    ->where('class_id', $request->input('payment_id')) // Check against payment_id
                    ->first();

                // If no existing assignment is found, create a new one
                if (!$existingAssignment) {
                    $assignment = assign::create([
                        'grade' => $request->input('grade'),
                        'adviser' => $class->adviser,
                        'section' => $class->section,
                        'edpcode' => $class->edpcode,
                        'room' => $class->room,
                        'subject' => $class->subject,
                        'description' => $class->description,
                        'type' => $class->type ?? null,
                        'unit' => $class->unit,
                        'time' => $class->time,
                        'days' => $class->days,
                        'class_id' => $request->input('payment_id'), // Set class_id from payment_id
                        'status' => 'assigned', // Set status to assigned
                    ]);

                    // Update class properties
                    $class->assign_id = $request->input('payment_id'); // Assigning the same value
                    $class->status = 'assigned'; // Update status
                    $class->save(); // Save the changes to the class

                    // Mark that at least one class has been assigned
                    $anyAssigned = true;
                }
            }
        }

        // Store the assignment status in the session
        if ($anyAssigned) {
            session(['assigningStatus' => 'assigned']); // Store session variable
            return redirect('/sectioning')->with('success', 'Classload assigned successfully.');
        } else {
            session(['assigningStatus' => 'not_assigned']); // Store session variable for no assignments
            return redirect('/sectioning')->with('error', 'No classes were assigned or duplicate entries were avoided.');
        }
    }


    public function updateProfile(Request $request)
    {
        $validatedData = $request->validate([
            'firstname' => 'required|string|max:255',
            'middlename' => 'nullable|string|max:255',
            'lastname' => 'required|string|max:255',
            'suffix' => 'nullable|string|max:10',
        ]);

        $userId = Auth::id();
        $profile = register_form::find($userId);
        $users = User::find($userId);
        $studentdetails = studentdetails::find($userId);

        if (!$profile) {
            return response()->json(['error' => 'Profile not found.'], 404);
        }

        // Update the profile in the database
        $profile->update($validatedData);
        $users->update($validatedData);
        $studentdetails->update($validatedData);

        Log::info('Profile updated:', $validatedData);

        return response()->json(['success' => 'Profile updated successfully.']);
    }

    public function gradesubmitpost(Request $request)
    {
        try {
            // Validate the incoming request data
            $validateData = $request->validate([
                'fullname' => 'required',
                'section' => 'required',
                'edp_code' => 'required',
                'subject' => 'required',
                '1st_quarter' => 'required',
                '2nd_quarter' => 'required',
                '3rd_quarter' => 'required',
                '4th_quarter' => 'required',
                'overall_grade' => 'required',
                'payment_id' => 'required|integer' // Validate payment_id
            ]);

            $validateData['status'] = 'pending'; // Set status here
            $validateData['grade_id'] = $request->input('payment_id'); // Set grade_id from payment_id

            // Create the grade entry
            grade::create($validateData);

            return redirect('/gradesubmit')->with('success', 'Student Grade submitted successfully.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect('/gradesubmit')->with('error', 'Failed to submit grade.');
        }
    }
    public function publish($id)
    {
        $grades = grade::findOrFail($id);


        if ($grades->status === 'pending') {

            $grades->status = 'approved';
            $grades->save();

            return redirect('submittedgrades')->with('success', 'Grade status updated to approved.');
        }

        return redirect('submittedgrades')->with('error', 'Grade status cannot be updated.');
    }

    public function teachercorevaluepost(Request $request)
    {
        $request->validate([
            'respect.*' => 'required|string',
            'excellence.*' => 'required|string',
            'teamwork.*' => 'required|string',
            'innovation.*' => 'required|string',
            'sustainability.*' => 'required|string',
            'student_ids.*' => 'required|exists:grades,id', // Adjust as necessary
        ]);

        // Loop through student IDs and save core values
        foreach ($request->student_ids as $index => $studentId) {
            corevalues::create([
                'student_id' => $studentId,
                'respect' => $request->respect[$index],
                'excellence' => $request->excellence[$index],
                'teamwork' => $request->teamwork[$index],
                'innovation' => $request->innovation[$index],
                'sustainability' => $request->sustainability[$index],
            ]);
        }

        return redirect()->back()->with('success', 'Core values saved successfully!');
    }
    public function studentapplicant(Request $request)
    {

        $request->validate([
            'students' => 'required|array',
            'students.*' => 'exists:register_form,id',
        ]);

        foreach ($request->students as $studentId) {

            $student = register_form::find($studentId);


            $student->status = 'approved';
            $student->save();


            $user = User::create([
                'firstname' => $student->firstname,
                'lastname' => $student->lastname,
                'middlename' => $student->middlename,
                'suffix' => $student->suffix,
                'role' => 'Newstudent',
                'email' => $student->email,
                'password' => $student->password,
            ]);


            FacadesMail::to($user->email)->send(new ApproveStudent($user));
        }

        return redirect()->back()->with('success', 'Selected students have been approved and notified.');
    }

    public function cashierstudentfeepost(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'payments' => 'required|array',
            'payments.*' => 'exists:payment_form,payment_id', // Ensure each payment ID exists
        ]);

        // Get the selected payment IDs
        $paymentIds = $request->input('payments');
        $approvedPayments = [];

        foreach ($paymentIds as $id) {
            // Find the payment record
            $paymentForm = payment_form::where('payment_id', $id)->first();

            if ($paymentForm && $paymentForm->status === 'pending') {
                // Update the payment status
                $paymentForm->status = 'approved';
                $paymentForm->save();

                $approvedPayments[] = $id; // Collect approved payment IDs
            }
        }

        // Check if any payments were approved and handle user role
        if (!empty($approvedPayments)) {
            $user = Auth::user();
            if ($user instanceof User) {
                $user->role = 'Oldstudent';
                $user->save();

                // Send notification email
                FacadesMail::to($user->email)->send(new ApprovePayment($user->toArray()));
            }
        }

        return redirect()->back()->with('success', 'Selected payments have been approved and notified.');
    }

    public function showTeachers()
    {
        // Fetch users with the role 'teacher'
        $teachers = User::where('role', 'teacher')->get()->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => trim($user->firstname . ' ' . $user->middlename . ' ' . $user->lastname),
                'assigned' => Teacher::where('name', trim($user->firstname . ' ' . $user->middlename . ' ' . $user->lastname))->exists(),
            ];
        });

        return view('principalteacher', compact('teachers'));
    }

    // Handle the assignment of a teacher to a subject
    public function teachersubjectpost(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|exists:users,id', // Ensure 'name' is an existing teacher ID
            'subject' => 'required|string',
        ]);

        // Fetch the teacher by ID from the User table
        $user = User::find($validatedData['name']);

        // Create or update the teacher record in the Teacher table
        teacher::updateOrCreate(
            ['name' => trim($user->firstname . ' ' . $user->middlename . ' ' . $user->lastname)],
            ['subject' => $validatedData['subject']]
        );

        return redirect()->back()->with('success', 'Teacher assigned successfully.');
    }
}
