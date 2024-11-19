<?php

use App\Http\Controllers\Datacontroller;
use App\Http\Controllers\Pagecontroller;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\Usercontroller;
use Dompdf\FrameDecorator\Page;
use Illuminate\Support\Facades\Mail;
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
Route::get('studentdetails/{registerFormId}', [UserController::class, 'studentdetails'])->middleware('auth');

Route::post('/update-profile', [Datacontroller::class, 'updateProfile'])->name('update.profile');

Route::get('address_contact', [Pagecontroller::class, 'address_contact'])->middleware('auth');
Route::post('address_contact', [Datacontroller::class, 'address_contactpost'])->middleware('auth');
Route::get('address_contact/{registerFormId}', [UserController::class, 'address_contact'])->name('address_contact')->middleware('auth');


Route::get('previous_school', [Pagecontroller::class, 'previous_school'])->middleware('auth');
Route::post('previous_school', [Datacontroller::class, 'previous_schoolpost'])->middleware('auth');
Route::get('previous_school/{registerFormId}', [UserController::class, 'previous_school'])->name('previous_school')->middleware('auth');


Route::get('required_documents', [Pagecontroller::class, 'required_documents'])->middleware('auth');
Route::post('required_documents', [Datacontroller::class, 'required_documents_post'])->middleware('auth');
Route::get('required_documents/{registerFormId}', [UserController::class, 'required_documents'])->name('required_documents')->middleware('auth');



Route::get('payment_process', [Pagecontroller::class, 'payment_process']);
Route::post('payment_process', [Datacontroller::class, 'payment_processpost']);
Route::get('payment_process/{registerFormId}', [UserController::class, 'payment_process'])->name('payment_process')->middleware('auth');

//student
Route::get('studentdashboard', [Pagecontroller::class, 'studentdashboard'])->middleware('auth');
Route::get('studentprofile', [Pagecontroller::class, 'studentprofile']);
Route::get('studentprofile', [Usercontroller::class, 'studentprofile'])->middleware('auth');

Route::get('studentclassload', [Pagecontroller::class, 'studentclassload'])->middleware('auth');
Route::get('/student-class-load/pdf', [PDFController::class, 'generatePDF'])->name('student.classload.pdf');

Route::get('enrollmentstep', [Pagecontroller::class, 'enrollmentstep']);


Route::get('studentgrades', [PageController::class, 'studentgrades'])->middleware('auth');
Route::get('studentassessment', [Pagecontroller::class, 'studentassessment']);


//teacher
Route::get('teacher', [Pagecontroller::class, 'teacher'])->middleware('auth');
Route::get('teachernotification', [Pagecontroller::class, 'teachernotification'])->middleware('auth');
Route::get('teacherprofile', [Pagecontroller::class, 'teacherprofile'])->middleware('auth');
Route::get('teacherclassload', [Pagecontroller::class, 'teacherclassload'])->middleware('auth');
Route::get('teacherclassload', [Usercontroller::class, 'teacherclassload'])->middleware('auth');


Route::get('gradesubmit', [Pagecontroller::class, 'gradesubmit'])->middleware('auth');
Route::post('gradesubmit', [Datacontroller::class, 'gradesubmitpost'])->middleware('auth');
Route::get('gradesubmit/{id}', [Usercontroller::class, 'gradesubmit'])->middleware('auth');

Route::get('teacherattendance', [Pagecontroller::class, 'teacherattendance'])->middleware('auth');
Route::get('teachercorevalue', [Pagecontroller::class, 'teachercorevalue'])->middleware('auth');



//principal
Route::get('principal', [Pagecontroller::class, 'principal']);
Route::get('sectioning', [Pagecontroller::class, 'sectioning']);
Route::get('sectioning/{id}', [Usercontroller::class, 'sectioning']);

Route::get('principalteacher', [Pagecontroller::class, 'principalteacher']);
Route::get('/principalteacher', [DataController::class, 'showTeachers'])->name('principalteacher');
Route::post('/principalteacher', [DataController::class, 'teachersubjectpost']);

Route::get('submittedgrades', [Pagecontroller::class, 'submittedgrades']);
Route::post('/update-quarters', [Datacontroller::class, 'updateQuarters'])->name('update.quarters');
Route::get('/submittedgrades', [Datacontroller::class, 'showEvaluateGrades'])->name('evaluate.grades');


Route::get('assigning', [Pagecontroller::class, 'assigning']);
Route::get('assigning/{id}', [Usercontroller::class, 'assigning']);
Route::post('assigning', [Datacontroller::class, 'assigning']);

Route::post('/assigning/{id}', [Datacontroller::class, 'approveAssigning']);

Route::get('section', [Pagecontroller::class, 'section']);
Route::get('section/{id}/{sectionName}', [UserController::class, 'section']);

Route::post('section', [Datacontroller::class, 'section']);
Route::get('section/{section}', [Usercontroller::class, 'getSectionDetails']);

Route::get('principalclassload', [Pagecontroller::class, 'principalclassload']);
Route::post('principalclassload', [Datacontroller::class, 'classloadpost']);
Route::get('/get-teachers/{grade}', [UserController::class, 'getTeachersByGrade']);
Route::get('/principalclassload', [Datacontroller::class, 'principalclassload'])->name('principalclassload');
Route::get('/get-teachers', [Usercontroller::class, 'getTeachersBySubjectAndGrade']);


Route::get('createsection', [Pagecontroller::class, 'createsection']);
Route::post('createsection', [Datacontroller::class, 'createsectionpost']);
Route::delete('section/{id}', [Usercontroller::class, 'deleteSection'])->name('section.delete');


Route::get('/get-subject/{teacherId}', [UserController::class, 'getSubject']);
Route::get('/get-assigned-teacher/{subject}', [UserController::class, 'getAssignedTeacher']);
Route::get('/update_class/{id}', [UserController::class, 'update_class']);
Route::put('/update_class/{id}', [Datacontroller::class, 'updateClass'])->name('update_class');
Route::get('/delete_class/{id}', [UserController::class, 'delete_class']);




Route::get('publishgrade', [Pagecontroller::class, 'publishgrade']);
Route::get('publishgrade/{id}', [Usercontroller::class, 'publishgrade']);
Route::post('publishgrade/{id}', [Datacontroller::class, 'publish'])->name('grades.publish');

//accounting 
Route::get('accounting', [Pagecontroller::class, 'accounting']);
Route::get('accountingprofile', [Pagecontroller::class, 'accountingprofile']);
Route::get('accountingassessment', [Pagecontroller::class, 'accountingassessment']);
Route::get('createassessment', [Pagecontroller::class, 'createassessment']);
Route::post('/createassessment', [Datacontroller::class, 'assessmentpost'])->name('assessment.post');




//record
Route::get('record', [Pagecontroller::class, 'record']);
Route::get('studententries', [Pagecontroller::class, 'studententries']);
Route::get('showdetails', [Pagecontroller::class, 'showdetails']);
Route::get('showdetails/{id}', [Usercontroller::class, 'showStudentDetails']);
Route::get('studentapplicant', [Pagecontroller::class, 'studentapplicant']);
Route::get('studentapplicant/{id}', [Usercontroller::class, 'studentapplicant']);
Route::post('studentapplicant', [Datacontroller::class, 'studentapplicant']);

Route::get('approvedaccount', [Pagecontroller::class, 'approvedaccount']);
Route::get('approvedaccount/{id}', [Usercontroller::class, 'approvedaccount']);

Route::get('recordapproval', [Pagecontroller::class, 'recordapproval']);
Route::post('recordapproval', [Datacontroller::class, 'recordapprovalpost']);
Route::get('recordapproval/{id}', [Usercontroller::class, 'recordapproval']);


//cashier
Route::get('cashier', [Pagecontroller::class, 'cashier']);
Route::get('cashierstudentfee', [Pagecontroller::class, 'cashierstudentfee']);
Route::post('cashierstudentfee', [Datacontroller::class, 'cashierstudentfeepost']);
Route::get('approvedpayment', [Pagecontroller::class, 'approvedpayment']);
Route::get('cashierstudentfee/{id}', [Usercontroller::class, 'cashierstudentfee']);
Route::get('proofofpayment', [Pagecontroller::class, 'proofofpayment']);
Route::get('/proofofpayment/{id}', [Usercontroller::class, 'proofofpayment']);

Route::post('/proofofpayment/{id}', [DataController::class, 'approvePayment']);

//admin
Route::get('admin', [Pagecontroller::class, 'admin']);
Route::get('adminmanageclassload', [Pagecontroller::class, 'adminmanageclassload']);

Route::get('adminusers', [Pagecontroller::class, 'adminusers']);
Route::post('adminusers', [Datacontroller::class, 'adminuserspost']);

Route::get('adminnotification', [Pagecontroller::class, 'adminnotification']);
Route::get('adminstudent', [Pagecontroller::class, 'adminstudent']);
Route::get('adminreport', [Pagecontroller::class, 'adminreport']);
Route::get('adminprofile', [Pagecontroller::class, 'adminprofile']);

Route::get('/enrollmentstep', [DataController::class, 'enrollmentStep'])->name('enrollment.step');

Route::get('updatedetails', [Pagecontroller::class, 'updatedetails'])->middleware('auth')->name('updatedetails');
Route::post('updatedetails', [Datacontroller::class, 'updatedetailspost'])->middleware('auth');
Route::get('/updatedetails/{id}', [Usercontroller::class, 'updatedetails'])->name('updatedetails.id');

Route::get('updateaddress', [Pagecontroller::class, 'updateaddress'])->middleware('auth')->name('updateaddress');
Route::post('updateaddress', [Datacontroller::class, 'updateaddresspost'])->middleware('auth');
Route::get('updateaddress/{id}', [Usercontroller::class, 'updateaddress'])->middleware('auth')->name('updateaddress.id');


Route::get('updatedocuments', [Pagecontroller::class, 'updatedocuments'])->middleware('auth')->name('updatedocuments');
Route::post('updatedocuments', [Datacontroller::class, 'updatedocumentspost'])->middleware('auth');
Route::get('updatedocuments/{id}', [Usercontroller::class, 'updatedocuments'])->middleware('auth')->name('updatedocuments.id');
Route::post('/updatedocuments', [Datacontroller::class, 'updateDocuments'])->name('updatedocuments');



//delete image
Route::delete('/documents/{id}', [Datacontroller::class, 'destroy']);


Route::get('updateschool', [Pagecontroller::class, 'updateschool'])->middleware('auth')->name('updateschool');
Route::post('updateschool', [Datacontroller::class, 'updateschoolpost'])->middleware('auth');
Route::get('updateschool/{id}', [UserController::class, 'updateschool'])->middleware('auth')->name('updateschool.id');
