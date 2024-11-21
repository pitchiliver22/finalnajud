<?php

namespace App\Http\Controllers;
use App\Constants\QuarterStatus;
use App\Mail\ApprovePayment;
use App\Mail\ApproveSectioning;
use App\Mail\AssessmentCreated;
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
use App\Models\assessment;
use App\Models\section;
use App\Models\subject;
use App\Models\QuarterSettings;
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
                    // Retrieve the associated register_form for the Newstudent
                    $registerForm = register_form::where('user_id', $user->id)->first();
                
                    // Log the user ID and the register form retrieved for debugging
                    Log::info('User ID:', ['user_id' => $user->id]);
                    Log::info('Register Form:', ['registerForm' => $registerForm]);
                
                    if ($registerForm) {
                        // Check if the status is approved
                        if ($registerForm->status === register_form::STATUS_APPROVED) {
                            // Log the successful status check
                            Log::info('Register Form approved:', ['registerFormId' => $registerForm->user_id]);
                            return redirect('/studentdetails/' . $registerForm->id)
                                ->with('success', 'Welcome, New Student!');
                        } else {
                            // If the registration is pending approval
                            sweetalert()->warning('Your account is pending approval.');
                            return redirect('/login')->with('error', 'Your registration is still pending approval.');
                        }
                    } else {
                        // If no registration form found for the user
                        sweetalert()->warning('No registration details found.');
                        return redirect('/login')->with('error', 'No registration details found.');
                    }
            case 'Oldstudent':
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
    } else {
        // Authentication failed
        sweetalert()->error('Pending account approval. Please try again.');
        return redirect('/login')->withErrors([
            'email' => 'The provided email is incorrect.',
            'password' => 'The provided password is incorrect.',
        ])->onlyInput('email');
    }
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
    // Get the authenticated user
    $user = Auth::user();

    // Fetch the user's register form
    $registerForm = register_form::where('user_id', $user->id)->first();

    // Check if the register form exists
    if (!$registerForm) {
        return redirect()->back()->with('error', 'No registration form found for the current user.');
    }

    // Validate incoming data
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

        'details_id' => 'required|in:' . $registerForm->id,
    ]);

    // Optionally add the status field
    $validateData['status'] = 'pending';

    // Create the student details record
    studentdetails::create($validateData);

    // Check the status of the register form
    if ($registerForm->status === register_form::STATUS_APPROVED) {
        return redirect('/address_contact/' . $registerForm->id)->with('success', 'Welcome, New Student!');
    } else {
        return redirect('/studentdetails')->with('error', 'Your registration is still pending approval.');
    }
}


public function address_contactpost(Request $request)
{
    $validateData = $request->validate([
        'zipcode' => 'required',
        'province' => 'required',
        'city' => 'required',
        'barangay' => 'required',
        'streetaddress' => 'required',
        'address_id' => 'required|exists:register_form,id',
    ]);

    $validateData['status'] = 'pending';

    address::create($validateData);
    $user = Auth::user();
    $registerForm = register_form::where('user_id', $user->id)->first();
        if ($registerForm->status === register_form::STATUS_APPROVED) {
            return redirect('/previous_school/' . $registerForm->id)->with('success', 'Address and contact submitted successfully.');
        } else {
            // Handle case where status is not approved
           
            return redirect('/address_contact')->with('error', 'Your registration is still pending approval.');
        }
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
        'password' => bcrypt($validateData['password']), // Store hashed password
    ]);

    // Send approval email
    FacadesMail::to($user->email)->send(new ApproveStudent($user));

    // Update the register_form status to approved
    $registerForm = register_form::findOrFail($validateData['id']);
    $registerForm->status = register_form::STATUS_APPROVED;
    $registerForm->user_id = $user->id; // Set the user_id to the newly created user's ID
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

            'school_id' => 'required|exists:register_form,id',
        ]);

        $validatedData['status'] = 'pending';

        previous_school::create($validateData);

        $user = Auth::user();
        $registerForm = register_form::where('user_id', $user->id)->first();
            if ($registerForm->status === register_form::STATUS_APPROVED) {
                return redirect('/required_documents/' . $registerForm->id)->with('success', 'Previous school submitted successfully.');
            } else {
                // Handle case where status is not approved
               
                return redirect('/previous_school')->with('error', 'Your registration is still pending approval.');
            }
        
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
        'required_id' => 'required|exists:register_form,id',
    ]);

    // Prepare for document upload
    $uploadedTypes = []; // Track uploaded types
    $filesUploaded = []; // To track successfully uploaded files

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
        $filesUploaded[] = $filePath; // Track uploaded files
    }

    // Redirect based on registration status
    $user = Auth::user();
    $registerForm = register_form::where('user_id', $user->id)->first();

    if ($registerForm->status === register_form::STATUS_APPROVED) {
        return redirect('/payment_process/' . $registerForm->id)->with('success', 'Required Documents submitted successfully.');
    } else {
        return redirect('/previous_school')->with('error', 'Your registration is still pending approval.');
    }
}

    public function payment_processpost(Request $request)
    {
        $request->validate([
            'payment-proof' => 'required|image|mimes:jpg,jpeg,png,bmp|max:2048',
            'level' => 'required|string',
            'payment-details' => 'required|string|max:1000',
            'payment_id' => 'required|integer|exists:register_form,id',
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
    ]);

    // Get the authenticated user's ID
    $userId = Auth::user()->id;

    // Find the register form associated with the authenticated user
    $registerForm = \App\Models\register_form::where('user_id', $userId)->first();

    if (!$registerForm) {
        return redirect()->route('enrollment.step')->withErrors('No registration form found.');
    }

    // Find the student details using the register form ID
    $studentDetail = \App\Models\StudentDetails::where('details_id', $registerForm->id)->first();

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
            
        ]);
        $userId = Auth::user()->id;
    
        // Find the student details by the authenticated user's ID (details_id)
        $registerForm = \App\Models\register_form::where('user_id', $userId)->first();
    

        $address = \App\Models\address::where('address_id', $registerForm->id)->first();

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

           
        ]);

        $userId = Auth::user()->id;
    
        // Find the student details by the authenticated user's ID (details_id)
        $registerForm = \App\Models\register_form::where('user_id', $userId)->first();
    
        $previousSchool = \App\Models\previous_school::where('school_id', $registerForm->id)->first();
        
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
            'required_id' => 'required|integer',
        ]);
    
        $userId = Auth::user()->id;
        $registerForm = \App\Models\register_form::where('user_id', $userId)->first();
    
        if (!$registerForm) {
            return redirect()->route('enrollment.step')->withErrors('Register form not found.');
        }
    
        // Find the required documents based on the registerForm ID
        $requiredDocs = \App\Models\required_docs::where('required_id', $registerForm->id)->first();
    
        if ($this->documentsUploaded($request)) {
            return $this->handleDocumentUpload($validateData, $requiredDocs);
        }
    
        return $this->approveExistingDocuments($request, $validateData['required_id'], $requiredDocs);
    }

    private function documentsUploaded($request)
    {
        return $request->has('documents') && count($request->file('documents')) > 0;
    }

        private function handleDocumentUpload($validateData, $requiredDocs)
    {
        $uploadedTypes = [];

        foreach ($validateData['documents'] as $index => $file) {
            $docType = $validateData['type'][$index];

            // Check if the document type already exists
            if (in_array($docType, $uploadedTypes)) {
                continue;
            }

            // Store the uploaded document
            $filePath = $file->store('documents', 'public');

            // Create a new record in required_docs
            required_docs::create([
                'type' => $docType,
                'documents' => $filePath,
                'required_id' => $validateData['required_id'],
                'status' => 'approved', 
            ]);

            $uploadedTypes[] = $docType; 
        }

        return redirect()->route('enrollment.step')->with('success', 'Documents uploaded and approved successfully.');
    }

    public function approveExistingDocuments(Request $request, $requiredId, $requiredDocs)
    {
        $request->validate([
            'required_id' => 'required|integer',
        ]);
    
        // Optionally, check if $requiredDocs is not null or meets specific criteria
        if (!$requiredDocs) {
            return redirect()->route('enrollment.step')->withErrors('No required documents found for the selected ID.');
        }
    
        $existingDocs = required_docs::where('required_id', $requiredId)->get();
    
        if ($existingDocs->isNotEmpty()) {
            foreach ($existingDocs as $doc) {
                $doc->update(['status' => 'approved']);
            }
            return redirect()->route('enrollment.step')->with('success', 'Documents approved successfully.');
        }
    
        return redirect()->route('enrollment.step')->withErrors('No documents found for the required ID.');
    }

    public function updateDocuments(Request $request)
    {
        // Validate the request data
        $request->validate([
            'required_id' => 'required|integer',
        ]);

        // Retrieve the authenticated user's ID
        $userId = Auth::user()->id;

        // Find the register form associated with the authenticated user
        $registerForm = \App\Models\register_form::where('user_id', $userId)->first();

        if (!$registerForm) {
            return redirect()->route('enrollment.step')->withErrors('Register form not found.');
        }

        // Find the required documents based on the registerForm ID
        $requiredDocs = \App\Models\required_docs::where('required_id', $registerForm->id)->first();

        // Call the approveExistingDocuments method, passing the request and the requiredDocs
        return $this->approveExistingDocuments($request, $request->required_id, $requiredDocs);
    }

    public function enrollmentStep()
{
    // Ensure the user is authenticated
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    // Get the authenticated user
    $user = Auth::user();

    // Fetch the register form associated with the authenticated user
    $registerForm = register_form::where('user_id', $user->id)->first();

    // Handle case where no register form is found
    if (!$registerForm) {
        return redirect()->route('/enrollmentstep')->with('error', 'No registration form found.');
    }

    // Use the registerForm's ID to fetch related records
    $registerFormId = $registerForm->id;

    // Fetch related records using the primary key of register_form
    $studentDetail = studentdetails::where('details_id', $registerFormId)->first();
    $address = address::where('address_id', $registerFormId)->first();
    $payment = payment_form::where('payment_id', $registerFormId)->first();
    $previousSchool = previous_school::where('school_id', $registerFormId)->first();
    $requiredDocs = required_docs::where('required_id', $registerFormId)->first();
    $assign = assign::where('class_id', $registerFormId)->first();

    $allCompleted = true;

    $paymentStatus = $payment ? $payment->status : null;
    if ($paymentStatus !== 'approved') {
        $allCompleted = false;
    }

    $detailsStatus = $studentDetail ? $studentDetail->status : null;
    if ($detailsStatus !== 'approved') {
        $allCompleted = false;
    }

    $addressStatus = $address ? $address->status : null;
    if ($addressStatus !== 'approved') {
        $allCompleted = false;
    }

    $previousStatus = $previousSchool ? $previousSchool->status : null;
    if ($previousStatus !== 'approved') {
        $allCompleted = false;
    }

    $requiredStatus = $requiredDocs ? $requiredDocs->status : null;
    if ($requiredStatus !== 'approved') {
        $allCompleted = false;
    }

    $assignStatus = $assign ? $assign->status : null;
    if ($assignStatus !== 'assigned') {
        $allCompleted = false;
    }

    // Extract address_id
    $address_id = $address ? $address->address_id : null;
    $details_id = $studentDetail ? $studentDetail->details_id : null;
    $school_id  = $previousSchool ? $previousSchool->school_id : null;
    $required_id = $requiredDocs ? $requiredDocs->required_id : null;
    $payment_id = $payment ? $payment->payment_id : null;
    $class_id = $assign ? $assign->class_id : null;

    // Pass the statuses and the allCompleted flag to the view
    return view('enrollmentstep', compact(
        'allCompleted', // Pass the combined status flag
        'detailsStatus', 
        'addressStatus', 
        'previousStatus', 
        'paymentStatus', 
        'requiredStatus', 
        'assignStatus', 
        'registerFormId', 
        'registerForm',  
        'address_id',
        'details_id',
        'school_id',
        'required_id',
        'payment_id',
        'class_id'
    ));
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
        // Validate the incoming request data
        $validatedData = $request->validate([
            'grade' => 'required',
            'adviser' => 'required|exists:teachers,id',
            'section' => 'required',
            'edpcode' => 'required',
            'subject' => 'required',
            'room' => 'required',
            'description' => 'required',
            'type' => 'nullable|string',
            'unit' => 'required|integer|max:3',
            'startTime' => 'required|date_format:H:i',
            'endTime' => 'required|date_format:H:i',
            'days' => 'required',
        ]);
    
        $teacher = Teacher::find($validatedData['adviser']);
        if (!$teacher) {
            return redirect('/principalclassload')->withErrors(['error' => 'Selected teacher not found.'])->withInput();
        }
        $teacherName = trim($teacher->name);
    
        // Check existing schedules for the specified section
        $existingSchedules = classes::where('grade', $validatedData['grade'])
            ->where('section', strtoupper($validatedData['section'])) // Ensure case consistency
            ->count();
    
        // Handle warnings and maximum schedule checks
        if ($existingSchedules >= 10) {
            return redirect('/principalclassload')->withErrors(['error' => 'Maximum of 10 schedules reached for this section.'])->withInput()->with([
                'sections' => section::all(),
                'teachers' => teacher::all(),
                'selectedGrade' => $validatedData['grade'],
                'selectedSection' => strtoupper($validatedData['section']),
                'selectedSubject' => strtoupper($validatedData['subject']),
                'selectedAdviser' => $validatedData['adviser'],
            ]);
        }
    
        if ($existingSchedules == 10) {
            return redirect('/principalclassload')->with('warning', 'Warning: The section has reached 10 schedules. Maximum is 10.')->withInput()->with([
                'sections' => section::all(),
                'teachers' => teacher::all(),
                'selectedGrade' => $validatedData['grade'],
                'selectedSection' => strtoupper($validatedData['section']),
                'selectedSubject' => strtoupper($validatedData['subject']),
                'selectedAdviser' => $validatedData['adviser'],
            ]);
        }
    
        // Prepare class entry data
        $classData = [
            'grade' => $validatedData['grade'],
            'adviser' => $teacherName,
            'section' => strtoupper($validatedData['section']),
            'edpcode' => strtoupper($validatedData['edpcode']),
            'subject' => strtoupper($validatedData['subject']),
            'room' => strtoupper($validatedData['room']),
            'description' => strtoupper($validatedData['description']),
            'type' => $validatedData['type'],
            'unit' => strtoupper($validatedData['unit']),
            'startTime' => $validatedData['startTime'], 
            'endTime' => $validatedData['endTime'],    
            'days' => strtoupper($validatedData['days']),
            'status' => 'not assigned',
        ];
    
        // Check for conflicts: any teacher scheduled at the same time on the same day
        $timeConflict = classes::where('grade', $classData['grade'])
            ->where('section', $classData['section'])
            ->where('days', $classData['days'])
            ->where(function ($query) use ($validatedData) {
                $query->where('startTime', '<', $validatedData['endTime'])
                      ->where('endTime', '>', $validatedData['startTime']);
            })
            ->exists();
    
        // Handle conflict for any teacher at the same time
        if ($timeConflict) {
            return redirect('/principalclassload')->withErrors(['error' => 'Conflict detected: Another class is scheduled at this time on the same day.'])->withInput()->with([
                'sections' => section::all(),
                'teachers' => teacher::all(),
                'selectedGrade' => $validatedData['grade'],
                'selectedSection' => strtoupper($validatedData['section']),
                'selectedSubject' => strtoupper($validatedData['subject']),
                'selectedAdviser' => $validatedData['adviser'],
            ]);
        }
    
        // Create the class entry
        classes::create($classData);
    
        return redirect('/principalclassload')->with([
            'sections' => section::all(),
            'teachers' => teacher::all(),
            'selectedGrade' => $validatedData['grade'],
            'selectedSection' => strtoupper($validatedData['section']),
            'selectedSubject' => strtoupper($validatedData['subject']),
            'selectedAdviser' => $validatedData['adviser'],
        ])->with('success', 'Classload added successfully.');
    }

    public function principalclassload(Request $request)
{
    // Get selected values from the request
    $selectedGrade = $request->input('grade', session('selectedGrade'));
    $selectedSection = $request->input('section', session('selectedSection'));
    $selectedSubject = $request->input('subject', session('selectedSubject'));
    
    // Get all classes
    $class = classes::all();
    
    // Fetch all teachers
    $teachers = teacher::all();

    // Extract unique subjects from teachers
    $subjects = [];
    foreach ($teachers as $teacher) {
        $teacherSubjects = explode(',', $teacher->subject); // Assuming subjects are comma-separated
        foreach ($teacherSubjects as $subject) {
            $subjects[trim($subject)] = true; 
          }
    }
    $subjects = array_keys($subjects); 
    $filteredTeachers = teacher::where('grade', $selectedGrade)
                               ->where('subject', 'LIKE', '%' . $selectedSubject . '%')
                               ->get();
    
    $schedules = []; 

     if ($selectedGrade && $selectedSection) {
        $schedules = classes::where('grade', $selectedGrade)
                             ->where('section', $selectedSection)
                             ->get();
    }
    
    return view('principalclassload', compact('class', 'subjects', 'filteredTeachers', 'schedules', 'selectedGrade', 'selectedSection', 'selectedSubject'));
}



public function updateQuarters(Request $request)
{
    // Validate request
    $request->validate([
        '1st_quarter_enabled' => 'boolean',
        '2nd_quarter_enabled' => 'boolean',
        '3rd_quarter_enabled' => 'boolean',
        '4th_quarter_enabled' => 'boolean',
        'quarter_status' => 'required|in:active,inactive',
    ]);

    // Fetch existing settings or create a new one
    $settings = QuarterSettings::first();
    if ($settings) {
        $settings->first_quarter_enabled = $request->has('1st_quarter_enabled'); // true if checked
        $settings->second_quarter_enabled = $request->has('2nd_quarter_enabled');
        $settings->third_quarter_enabled = $request->has('3rd_quarter_enabled');
        $settings->fourth_quarter_enabled = $request->has('4th_quarter_enabled');
        
        // Update the overall quarter status
        $settings->quarter_status = $request->input('quarter_status');
        
        $settings->save();
    } else {
        QuarterSettings::create([
            'first_quarter_enabled' => $request->has('1st_quarter_enabled'),
            'second_quarter_enabled' => $request->has('2nd_quarter_enabled'),
            'third_quarter_enabled' => $request->has('3rd_quarter_enabled'),
            'fourth_quarter_enabled' => $request->has('4th_quarter_enabled'),
            'quarter_status' => $request->input('quarter_status'),
        ]);
    }

    return redirect()->back()->with('success', 'Quarter settings updated successfully.');
}

public function showEvaluateGrades()
{
    // Fetch the existing quarter settings
    $quarterSettings = QuarterSettings::first();

    // Initialize with default values if no settings found
    if (!$quarterSettings) {
        $quarterSettings = new QuarterSettings();
        $quarterSettings->first_quarter_enabled = false;
        $quarterSettings->second_quarter_enabled = false;
        $quarterSettings->third_quarter_enabled = false;
        $quarterSettings->fourth_quarter_enabled = false;
        $quarterSettings->quarter_status = 'inactive'; // Default status
    }

    // Prepare the quarters enabled and status arrays
    $quartersEnabled = [
        '1st_quarter' => $quarterSettings->first_quarter_enabled,
        '2nd_quarter' => $quarterSettings->second_quarter_enabled,
        '3rd_quarter' => $quarterSettings->third_quarter_enabled,
        '4th_quarter' => $quarterSettings->fourth_quarter_enabled,
    ];

    // Prepare the quarters status array
    $quartersStatus = [
        '1st_quarter' => $quarterSettings->quarter_status,
        '2nd_quarter' => $quarterSettings->quarter_status,
        '3rd_quarter' => $quarterSettings->quarter_status,
        '4th_quarter' => $quarterSettings->quarter_status,
    ];

    // Fetch other necessary data
    $assigns = Assign::all();
    $grades = Grade::all();

    // Return the principal interface view with all necessary variables
    return view('submittedgrades', [
        'quartersEnabled' => $quartersEnabled,
        'quartersStatus' => $quartersStatus,
        'quarterSettings' => $quarterSettings,
        'assigns' => $assigns,
        'grades' => $grades,
    ]);
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
    
        $anyAssigned = false;
    
        foreach ($request->selected_classes as $classEdpCode) {
            $class = Classes::where('edpcode', $classEdpCode)->first();
    
            if ($class) {
                $existingAssignment = Assign::where('edpcode', $class->edpcode)
                    ->where('class_id', $request->input('payment_id'))
                    ->first();
    
                if (!$existingAssignment) {
                    $assignment = Assign::create([
                        'grade' => $request->input('grade'),
                        'adviser' => $class->adviser,
                        'section' => $class->section,
                        'edpcode' => $class->edpcode,
                        'room' => $class->room,
                        'subject' => $class->subject,
                        'description' => $class->description,
                        'type' => $class->type ?? null,
                        'unit' => $class->unit,
                        'startTime' => $class->startTime,
                        'endTime' => $class->endTime,
                        'days' => $class->days,
                        'class_id' => $request->input('payment_id'),
                        'status' => 'assigned',
                    ]);
    
                    // Log the created assignment
                    Log::info('Assignment Created:', $assignment->toArray());
    
                    $class->assign_id = $request->input('payment_id');
                    $class->status = 'assigned';
                    $class->save();
    
                    $anyAssigned = true;
    
                }
            }
        }
    
        if ($anyAssigned) {
            return redirect('/sectioning')->with('success', 'Classload assigned successfully.');
        } else {
            return redirect('/sectioning')->with('error', 'No classes were assigned or duplicate entries were avoided.');
        }
    }

    public function section(Request $request)
    {
        $request->validate([
            'selected_classes' => 'required|array',
            'selected_classes.*' => 'string',
            'grade' => 'required|string',
            'payment_id' => 'required|integer',
        ]);
    
        $anyAssigned = false;
        $user = register_form::find($request->input('payment_id'));
    
        foreach ($request->selected_classes as $classEdpCode) {
            $class = classes::where('edpcode', $classEdpCode)->first();
    
            if ($class) {
                $existingAssignment = assign::where('edpcode', $class->edpcode)
                    ->where('class_id', $request->input('payment_id'))
                    ->first();
    
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
                        'startTime' => $class->startTime,
                        'endTime' => $class->endTime,
                        'days' => $class->days,
                        'class_id' => $request->input('payment_id'),
                        'status' => 'assigned',
                    ]);
    
                    // Log the created assignment
                    Log::info('Assignment Created:', $assignment->toArray());
    
                    $class->assign_id = $request->input('payment_id');
                    $class->status = 'assigned';
                    $class->save();
    
                    $anyAssigned = true;
    
                }
            }
        }
    
        if ($anyAssigned) {
            FacadesMail::to($user->email)->send(new ApproveSectioning($user));
            return redirect('/sectioning')->with('success', 'Classload assigned successfully and email sent.');
        } else {
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
            'edp_code' => 'required',
            'subject' => 'required',
            'grade_id' => 'required|integer',
            'fullname' => 'required',
            'section' => 'required',
            '1st_quarter' => 'nullable|numeric|min:0|max:100',
            '2nd_quarter' => 'nullable|numeric|min:0|max:100',
            '3rd_quarter' => 'nullable|numeric|min:0|max:100',
            '4th_quarter' => 'nullable|numeric|min:0|max:100',
            'overall_grade' => 'required|numeric|min:0|max:100'
        ]);

        // Prepare the data for insertion/updating
        $gradesData = [
            'fullname' => $validateData['fullname'],
            'section' => $validateData['section'],
            'edp_code' => $validateData['edp_code'],
            'subject' => $validateData['subject'],
            'grade_id' => $validateData['grade_id'],
            '1st_quarter' => $validateData['1st_quarter'] ?? null,
            '2nd_quarter' => $validateData['2nd_quarter'] ?? null,
            '3rd_quarter' => $validateData['3rd_quarter'] ?? null,
            '4th_quarter' => $validateData['4th_quarter'] ?? null,
            'overall_grade' => $validateData['overall_grade'],
            'status' => 'pending'
        ];

        // Use updateOrCreate
        Grade::updateOrCreate(
            [
                'edp_code' => $validateData['edp_code'], // Unique identifier
                'subject' => $validateData['subject'],
                'grade_id' => $validateData['grade_id'],
            ],
            $gradesData
        );

        return redirect()->back()->with('success', 'Student Grade submitted successfully.');
    } catch (\Exception $e) {
        Log::error($e->getMessage());
        return redirect()->back()->withInput()->withErrors(['Failed to submit grade: ' . $e->getMessage()]);
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

            $user = User::create([
                'firstname' => $student->firstname,
                'lastname' => $student->lastname,
                'middlename' => $student->middlename,
                'suffix' => $student->suffix,
                'role' => 'Newstudent',
                'email' => $student->email,
                'password' => $student->password,
            ]);

            $student->status = 'approved';
            $student->user_id = $user->id;
            $student->save();


            FacadesMail::to($user->email)->send(new ApproveStudent($user));
        }

        return redirect()->back()->with('success', 'Selected students have been approved and notified.');
    }

    public function cashierstudentfeepost(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'payments' => 'required|array',
            'payments.*' => 'exists:payment_form,id', // Ensure each payment ID exists
        ]);
    
        // Get the selected payment IDs
        $paymentIds = $request->input('payments');
        $approvedPayments = [];
    
        foreach ($paymentIds as $id) {
            // Find the payment record
            $paymentForm = payment_form::where('id', $id)->first();
    
            if ($paymentForm && $paymentForm->status === 'pending') {
                // Update the payment status
                $paymentForm->status = 'approved';
                $paymentForm->save();
    
                $approvedPayments[] = $id;
            }
        }
    
        // Check if any payments were approved
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
    
    public function teachersubjectpost(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|exists:users,id', 
        'grade' => 'required|string',
        'subject' => 'required|array', // Change to array to accept multiple subjects
        'subject.*' => 'string', // Validate each subject as a string
    ]);

    // Fetch the teacher by ID from the User table
    $user = User::find($validatedData['name']);

    // Check if the teacher's record already exists
    $teacherRecord = Teacher::where('name', trim($user->firstname . ' ' . $user->middlename . ' ' . $user->lastname))
                            ->where('grade', $validatedData['grade'])
                            ->first();

    if ($teacherRecord) {
        // Update existing record with new subjects
        $existingSubjects = explode(', ', $teacherRecord->subject);
        $newSubjects = $validatedData['subject'];
        $allSubjects = array_unique(array_merge($existingSubjects, $newSubjects)); // Merge and remove duplicates

        $teacherRecord->subject = implode(', ', $allSubjects); // Concatenate subjects
        $teacherRecord->updated_at = now();
        $teacherRecord->save();
    } else {
        // Create a new record
        teacher::create([
            'name' => trim($user->firstname . ' ' . $user->middlename . ' ' . $user->lastname),
            'subject' => implode(', ', $validatedData['subject']), // Store subjects as a single string
            'grade' => $validatedData['grade'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    // Fetch teachers again to pass back to the view
    $teachers = User::where('role', 'teacher')->get()->map(function ($user) {
        return [
            'id' => $user->id,
            'name' => trim($user->firstname . ' ' . $user->middlename . ' ' . $user->lastname),
            'assigned' => teacher::where('name', trim($user->firstname . ' ' . $user->middlename . ' ' . $user->lastname))->exists(),
        ];
    });

    return redirect()->route('principalteacher')->with([
        'teachers' => $teachers,
        'success' => 'Teacher assigned successfully.',
    ]);
}

    public function createsectionpost(Request $request)
    {
        $validatedData = $request->validate([
            'section' => 'required|string|max:255',
            'grade' => 'required|string|max:255',
        ]);
    
        // Check for duplicate section regardless of grade
        $existingSection = section::where('section', $validatedData['section'])->first();
    
        if ($existingSection) {
            // Redirect back with an error message
            return redirect()->back()->withErrors(['section' => 'This section already exists.']);
        }
    
        // Create a new section schedule
        $section = section::create([
            'section' => $validatedData['section'],
            'grade' => $validatedData['grade'],
        ]);
    
        // Redirect to the principalclassload with the created section data
        return redirect()->route('principalclassload', [
            'grade' => $section->grade,
            'section' => $section->section
        ])->with('success', 'Section created successfully.');
    }


    public function assessmentpost(Request $request)
    {
        $validatedData = $request->validate([
            'school_year' => 'required|string',
            'grade_level' => 'required|string',
            'assessment_name' => 'required|string|max:255',
            'description' => 'required|string',
            'assessment_date' => 'required|date',
            'assessment_time' => 'required|date_format:H:i', // Validate as 24-hour format
            'assessment_fee' => 'required|numeric|min:0',
        ]);
    
        $assessment = new assessment(); 
        $assessment->school_year = $validatedData['school_year'];
        $assessment->grade_level = $validatedData['grade_level'];
        $assessment->assessment_name = $validatedData['assessment_name'];
        $assessment->description = $validatedData['description'];
        $assessment->assessment_date = $validatedData['assessment_date'];
    
        $assessment->assessment_time = \Carbon\Carbon::createFromFormat('H:i', $validatedData['assessment_time'])->format('h:i A');
    
        $assessment->assessment_fee = $validatedData['assessment_fee'];
    
        $assessment->save();
    
        return redirect()->back()->with('success', 'Assessment created successfully!');
    }

    public function submitAssessment(Request $request, $assessmentId)
    {
        $assessment = Assessment::findOrFail($assessmentId);

        FacadesMail::to('principal@example.com')->send(new AssessmentCreated($assessment));

        return redirect()->back()->with('success', 'Assessment submitted successfully and principal notified!');
    }


    public function updateQuarter(Request $request, $assignId, $quarter, $status)
    {
        // Find the grade entry
        $grade = grade::where('id', $assignId)->first();

        if ($grade) {
            // Update the corresponding quarter status
            switch ($quarter) {
                case '1st':
                    $grade->first_quarter_enabled = (bool)$status;
                    break;
                case '2nd':
                    $grade->second_quarter_enabled = (bool)$status;
                    break;
                case '3rd':
                    $grade->third_quarter_enabled = (bool)$status;
                    break;
                case '4th':
                    $grade->fourth_quarter_enabled = (bool)$status;
                    break;
            }

            // Save the changes
            $grade->save();

            return response()->json(['message' => 'Quarter status updated successfully.']);
        }

        return response()->json(['message' => 'Grade not found.'], 404);
    }
}
