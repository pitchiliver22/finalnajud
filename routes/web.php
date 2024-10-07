<?php

use App\Http\Controllers\Datacontroller;
use App\Http\Controllers\Pagecontroller;
use App\Http\Controllers\Usercontroller;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('user', [Pagecontroller::class, 'user']);

Route::get('login', [Pagecontroller::class, 'login'])->name('login');
Route::post('login', [Datacontroller::class, 'loginPost']);
Route::get('logout', [Datacontroller::class, 'logout']);

Route::get('partialaccount', [Pagecontroller::class, 'partialaccount']);
Route::post('partialaccount', [Datacontroller::class, 'partialaccountpost']);

Route::get('register_consent', [Pagecontroller::class, 'register_consent']);

Route::get('/studentdetails', [PageController::class, 'studentdetails'])->name('studentdetails')->middleware('auth');
Route::post('studentdetails', [Datacontroller::class, 'studentdetailspost'])->middleware('auth');

Route::get('address_contact', [Pagecontroller::class, 'address_contact'])->middleware('auth');
Route::post('address_contact', [Datacontroller::class, 'address_contactpost'])->middleware('auth');


Route::get('previous_school', [Pagecontroller::class, 'previous_school'])->middleware('auth');
Route::post('previous_school', [Datacontroller::class, 'previous_schoolpost'])->middleware('auth');

Route::get('required_documents', [Pagecontroller::class, 'required_documents'])->middleware('auth');
Route::post('required_documents', [Datacontroller::class, 'required_documentspost'])->middleware('auth');

Route::get('payment_process', [Pagecontroller::class, 'payment_process']);


Route::get('studentdashboard', [Pagecontroller::class, 'studentdashboard'])->middleware('auth');

Route::get('studentprofile', [Pagecontroller::class, 'studentprofile']);

Route::get('studentclassload', [Pagecontroller::class, 'studentclassload']);

Route::get('enrollmentstep', [Pagecontroller::class, 'enrollmentstep']);


Route::get('studentgrades', [Pagecontroller::class, 'studentgrades']);
Route::get('studentassessment', [Pagecontroller::class, 'studentassessment']);


//teacher
Route::get('teacher', [Pagecontroller::class, 'teacher']);
Route::get('teachernotification', [Pagecontroller::class, 'teachernotification']);
Route::get('teacherprofile', [Pagecontroller::class, 'teacherprofile']);
Route::get('teacherclassload', [Pagecontroller::class, 'teacherclassload']);
Route::get('gradesubmit', [Pagecontroller::class, 'gradesubmit']);
Route::get('teacherattendance', [Pagecontroller::class, 'teacherattendance']);
Route::get('teachercorevalue', [Pagecontroller::class, 'teachercorevalue']);



//principal
Route::get('principal', [Pagecontroller::class, 'principal']);
Route::get('sectioning', [Pagecontroller::class, 'sectioning']);
Route::get('principalclassload', [Pagecontroller::class, 'principalclassload']);


//accounting 
Route::get('accounting', [Pagecontroller::class, 'accounting']);
Route::get('accountingprofile', [Pagecontroller::class, 'accountingprofile']);
Route::get('accountingassessment', [Pagecontroller::class, 'accountingassessment']);
Route::get('createassessmet', [Pagecontroller::class, 'createassessmet']);



//record
Route::get('record', [Pagecontroller::class, 'record']);
Route::get('studentapplicant', [Pagecontroller::class, 'studentapplicant']);
Route::get('studentapplicant/{id}', [Usercontroller::class, 'studentapplicant']);

Route::get('recordapproval', [Pagecontroller::class, 'recordapproval']);
Route::post('recordapproval', [Datacontroller::class, 'recordapprovalpost']);
Route::get('recordapproval/{id}', [Usercontroller::class, 'recordapproval']);


//cashier
Route::get('cashier', [Pagecontroller::class, 'cashier']);
Route::get('cashierstudentfee', [Pagecontroller::class, 'cashierstudentfee']);
Route::get('proofofpayment', [Pagecontroller::class, 'proofofpayment']);
Route::post('proofofpayment', [Datacontroller::class, 'proofofpaymentpost']);

//admin
Route::get('admin', [Pagecontroller::class, 'admin']);
Route::get('adminmanageclassload', [Pagecontroller::class, 'adminmanageclassload']);

Route::get('adminusers', [Pagecontroller::class, 'adminusers']);
Route::post('adminusers', [Datacontroller::class, 'adminuserspost']);

Route::get('adminnotification', [Pagecontroller::class, 'adminnotification']);
Route::get('adminstudent', [Pagecontroller::class, 'adminstudent']);
Route::get('adminreport', [Pagecontroller::class, 'adminreport']);
Route::get('adminprofile', [Pagecontroller::class, 'adminprofile']);









Route::get('updatedetails', [Pagecontroller::class, 'updatedetails'])->middleware('auth');
Route::post('updatedetails', [Datacontroller::class, 'updatedetailspost'])->middleware('auth');
Route::get('updatedetails/{id}', [Usercontroller::class, 'updatedetails'])->middleware('auth')->name('updatedetails');

Route::get('updateaddress', [Pagecontroller::class, 'updateaddress'])->middleware('auth');
Route::post('updateaddress', [Datacontroller::class, 'updateaddresspost'])->middleware('auth');
Route::get('updateaddress/{id}', [Usercontroller::class, 'updateaddress'])->middleware('auth')->name('updateaddress');


Route::get('updatedocuments', [Pagecontroller::class, 'updatedocuments'])->middleware('auth');
Route::post('updatedocuments', [Datacontroller::class, 'updatedocumentspost'])->middleware('auth');
Route::get('updatedocuments/{id}', [Usercontroller::class, 'updatedocuments'])->middleware('auth')->name('updatedocuments');



Route::get('updateschool', [Pagecontroller::class, 'updateschool'])->middleware('auth');
Route::post('updateschool', [Datacontroller::class, 'updateschoolpost'])->middleware('auth');
Route::get('updateschool/{id}', [Usercontroller::class, 'updateschool'])->middleware('auth');
