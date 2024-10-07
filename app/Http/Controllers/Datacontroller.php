<?php

namespace App\Http\Controllers;

use App\Models\address;
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

        register_form::create($validateData);
        return redirect('/login');
    }


    public function loginPost(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        if (Auth::attempt($credentials)) {
            // Check the authenticated user's role
            $user = Auth::user();

            if ($user->role === 'Teacher') {
                return redirect('/teacher')->with('success', 'Welcome, Teacher!');
            } elseif ($user->role === 'Newstudent') {
                return redirect('/studentdetails')->with('success', 'Welcome, New Student!');
            } elseif ($user->role === 'Oldstudent') {
                return redirect('/studentdashboard')->with('success', 'Welcome, Old Student!');
            } elseif ($user->role === 'Record') {
                return redirect('/record')->with('success', 'Welcome, Record!');
            } elseif ($user->role === 'Cashier') {
                return redirect('/cashier')->with('success', 'Welcome, Cashier!');
            } elseif ($user->role === 'Principal') {
                return redirect('/principal')->with('success', 'Welcome, Principal!');
            } elseif ($user->role === 'Accounting') {
                return redirect('/accounting')->with('success', 'Welcome, Accounting!');
            } else {

                return back()->with('error', 'Invalid user role.');
            }
            return $this->logout($request);
        }

        return back()->withErrors([
            'email' => 'The provided credentials are incorrect.',
            'password' => 'The provided credentials are incorrect.',
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

        studentdetails::create($validateData);
        return redirect('/address_contact')->with('success', 'Details submitted successfully.');
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

        address::create($validateData);
        return redirect('/previous_school')->with('success', 'Details submitted successfully.');
    }

    public function recordapprovalpost(Request $request)
    {
        $validateData = $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'middlename' => 'required',
            'suffix' => 'required',
            'role' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        User::create($validateData);
        return redirect('/studentapplicant');
    }

    public function previous_schoolpost(Request $request)
    {

        $validateData = $request->validate([
            'second_school_name' => 'required',
            'second_last_strand' => 'required',
            'second_last_year_level' => 'required',
            'second_school_year_from' => 'required',
            'second_school_year_to' => 'required',
            'second_school_type' => 'required',

            'primary_school_name' => 'required',
            'primary_last_year_level' => 'required',
            'primary_school_year_from' => 'required',
            'primary_school_year_to' => 'required',
            'primary_school_type' => 'required',

            'school_id' => 'required',
        ]);

        previous_school::create($validateData);
        return redirect('/required_documents');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login')->with('success', 'You have been logged out.');
    }

    public function required_documentspost(Request $request)
    {
        $validateData = $request->validate([
            'type' => 'required|string', // Update to match the input name
            'documents' => 'required|file|max:10240|mimes:jpg,png,pdf',
            'required_id' => 'required',
        ]);

        // Handle file upload
        if ($request->hasFile('documents')) {
            $file = $request->file('documents');
            $filePath = $file->store('documents', 'public'); // Store the file
            $validateData['documents'] = $filePath; // Add the file path to the data array
        }

        // Save the document type and file path
        required_docs::create([
            'type' => $validateData['type'],
            'documents' => $validateData['documents'],
            'required_id' => $validateData['required_id'],
        ]);

        return redirect('/payment_process');
    }

    public function proofofpaymentpost(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'payment-proof' => 'required|image|mimes:jpg,jpeg,png,bmp|max:2048', // Limit file size to 2MB
            'payment-details' => 'required|string|max:1000',
            'payment_id' => 'required|integer', // Validate payment_id (adjust as needed)
        ]);

        // Handle the uploaded file
        if ($request->hasFile('payment-proof')) {
            $file = $request->file('payment-proof');
            $filePath = $file->store('payment_proofs', 'public'); // Store in the public disk

            // Create a new payment record
            $payment = new payment_form();
            $payment->fee_type = 'Enrollment Fee'; // Static value
            $payment->amount = 500; // Static value
            $payment->payment_proof = $filePath; // Store the file path
            $payment->payment_details = $request->input('payment-details');
            $payment->payment_id = $request->input('payment_id'); // Include payment_id
            $payment->save(); // Save the record to the database

            $user = Auth::user();
            if ($user instanceof User) { // Explicitly check if $user is an instance of User
                $user->role = 'Oldstudent';
                $user->save(); // This should now be recognized correctly
            }
        }
        return redirect('/enrollmentstep')->with('success', 'Payment submitted successfully!');
    }

    public function updatedetailspost(Request $request)
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
            'details_id' => 'required|exists:studentdetails,id', // Ensure the ID exists
        ]);


        $studentDetail = studentdetails::find($request->details_id);


        $studentDetail->update($validateData);

        return redirect('/updatedetails')->with('success', 'Details Updated successfully.');
    }

    public function updateaddresspost(Request $request)
    {
        $validateData = $request->validate([
            'zipcode' => 'required',
            'province' => 'required',
            'city' => 'required',
            'barangay' => 'required',
            'streetaddress' => 'required',
            'address_id' => 'required|exists:addresses,id', // Ensure the ID exists
        ]);


        $address = address::find($request->address_id);


        $address->update($validateData);

        return redirect('/updateaddress')->with('success', 'Address updated successfully.');
    }

    public function updateschoolpost(Request $request)
    {
        $validateData = $request->validate([
            'second_school_name' => 'required',
            'second_last_strand' => 'required',
            'second_last_year_level' => 'required',
            'second_school_year_from' => 'required',
            'second_school_year_to' => 'required',
            'second_school_type' => 'required',

            'primary_school_name' => 'required',
            'primary_last_year_level' => 'required',
            'primary_school_year_from' => 'required',
            'primary_school_year_to' => 'required',
            'primary_school_type' => 'required',

            'school_id' => 'required|exists:previous_schools,id', // Ensure the ID exists
        ]);

        // Find the existing record
        $previousSchool = previous_school::find($request->school_id);

        // Update the record with validated data
        $previousSchool->update($validateData);

        return redirect('/required_documents')->with('success', 'School details updated successfully.');
    }
}
