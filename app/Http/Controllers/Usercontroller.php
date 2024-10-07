<?php

namespace App\Http\Controllers;

use App\Models\address;
use App\Models\previous_school;
use App\Models\register_form;
use App\Models\required_docs;
use App\Models\studentdetails;
use Illuminate\Http\Request;

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

        $docs = required_docs::findOrFail($id);

        return view('updatedocuments', compact('docs'));
    }
    public function updateschool($id)
    {

        $school = previous_school::findOrFail($id);

        return view('updateschool', compact('school'));
    }
}
