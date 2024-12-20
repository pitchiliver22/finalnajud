<?php

use App\Http\Controllers\Datacontroller;
use App\Http\Controllers\Pagecontroller;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\Usercontroller;
use App\Http\Controllers\AuthController;
use Dompdf\FrameDecorator\Page;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Mail\TestMail;

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
Route::get('/student/classload/pdf/{student_id}', [PDFController::class, 'generatePDF'])->name('student.classload.pdf');

Route::get('enrollmentstep', [Pagecontroller::class, 'enrollmentstep']);


Route::get('studentgrades', [PageController::class, 'studentgrades'])->middleware('auth');

Route::get('studentassessment', [Pagecontroller::class, 'studentassessment']);


//teacher
Route::get('teacher', [Pagecontroller::class, 'teacher'])->middleware('auth');
Route::get('teachernotification', [Pagecontroller::class, 'teachernotification'])->middleware('auth');
Route::get('teacherprofile', [Pagecontroller::class, 'teacherprofile'])->middleware('auth');

Route::get('teacherclassload', [Pagecontroller::class, 'teacherclassload'])->middleware('auth');

Route::get('/gradesubmit/{edp_code}/{teacher_id}', [Usercontroller::class, 'gradesubmit'])->name('gradesubmit');
Route::post('/gradesubmit', [Datacontroller::class, 'gradesubmitpost'])->name('gradesubmitpost');

Route::get('teacherattendance', [Pagecontroller::class, 'teacherattendance'])->middleware('auth');
Route::get('/teacherattendance/{teacher_id}/{edp_code}', [Usercontroller::class, 'teacherAttendanceSubmit'])->name('teacherattendance');
Route::post('/teacherattendance', [Datacontroller::class, 'teacherattendancepost']);

Route::get('teachercorevalue', [Pagecontroller::class, 'teachercorevalue'])->middleware('auth');
Route::post('/teachercorevalue', [Datacontroller::class, 'teachercorevaluepost'])->name('teachercorevaluesubmitpost');
Route::get('/teachercorevaluesubmit/{teacher_id}/{edp_code}', [UserController::class, 'teachercorevaluesubmit'])
    ->name('teachercorevaluesubmit');
    
Route::get('principal', [Pagecontroller::class, 'principal']);
Route::get('sectioning', [Pagecontroller::class, 'sectioning']);
Route::get('sectioning/{id}', [Usercontroller::class, 'sectioning']);

Route::get('principalteacher', [Pagecontroller::class, 'principalteacher']);
Route::get('/principalteacher', [DataController::class, 'showTeachers'])->name('principalteacher');
Route::post('/principalteacher', [DataController::class, 'teachersubjectpost']);

Route::get('principalprofile', [Pagecontroller::class, 'principalprofile']);

Route::post('/update-quarters', [Datacontroller::class, 'updateQuarters'])->name('update.quarters');
Route::get('/submittedgrades', [Pagecontroller::class, 'showEvaluateGrades'])->name('evaluate.grades');

Route::get('assigning', [Pagecontroller::class, 'assigning']);
Route::get('assigning/{id}', [Usercontroller::class, 'assigning']);
Route::post('assigning', [Datacontroller::class, 'assigning']);

// Route::post('/assigning/{id}', [Datacontroller::class, 'approveAssigning']);

Route::get('section', [PageController::class, 'section'])->name('section.index');

Route::get('section/{id}/{sectionName}', [UserController::class, 'section'])->name('section.show');

Route::post('section', [DataController::class, 'sectionpost']);
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
Route::get('/publishgrade', [Usercontroller::class, 'publishgrade'])->name('publishgrade');
Route::post('/publishgrades', [Datacontroller::class, 'publishGrades'])->name('publishgrade.post');

Route::get('principalassessment', [Pagecontroller::class, 'principalassessment'])->name('/principalassessment');;
Route::post('/assessment/publish/{id}', [Usercontroller::class, 'publishAssessment'])->name('assessment.publish');

Route::get('principaleditassessment', [Pagecontroller::class, 'principaleditassessment']);
Route::get('principaleditassessment/{id}', [UserController::class, 'principaleditassessment'])->name('assessment.editget');
Route::put('principaleditassessment/{id}', [DataController::class, 'principaleditassessmentpost'])->name('assessment.edit');

//accounting 
Route::get('accounting', [Pagecontroller::class, 'accounting']);
Route::get('accountingprofile', [Pagecontroller::class, 'accountingprofile']);
Route::get('accountingassessment', [Pagecontroller::class, 'accountingassessment']);
Route::get('createassessment', [Pagecontroller::class, 'createassessment']);
Route::post('/createassessment', [Datacontroller::class, 'assessmentpost'])->name('assessment.post');
Route::post('/assessment/submit/{id}', [DataController::class, 'submitAssessment'])->name('assessment.submit');

//record
Route::get('record', [Pagecontroller::class, 'record']);
Route::get('studententries', [Pagecontroller::class, 'studententries']);
Route::get('showdetails', [Pagecontroller::class, 'showdetails']);
Route::get('/showdetails/{id}', [Usercontroller::class, 'showStudentDetails']);


Route::get('studentapplicant', [Pagecontroller::class, 'studentapplicant']);
Route::get('studentapplicant/{id}', [Usercontroller::class, 'studentapplicant']);
Route::post('studentapplicant', [Datacontroller::class, 'studentapplicant']);

Route::get('approvedaccount', [Pagecontroller::class, 'approvedaccount']);
Route::get('approvedaccount/{id}', [Usercontroller::class, 'approvedaccount']);

Route::get('recordapproval', [Pagecontroller::class, 'recordapproval']);
Route::post('recordapproval', [Datacontroller::class, 'recordapprovalpost']);
Route::get('recordapproval/{id}', [Usercontroller::class, 'recordapproval']);

Route::get('recordprofile', [Pagecontroller::class, 'recordprofile']);


//cashier
Route::get('cashier', [Pagecontroller::class, 'cashier']);
Route::get('cashierstudentfee', [Pagecontroller::class, 'cashierstudentfee']);
Route::post('cashierstudentfee', [Datacontroller::class, 'cashierstudentfeepost']);
Route::get('approvedpayment', [Pagecontroller::class, 'approvedpayment']);
Route::get('cashierstudentfee/{id}', [Usercontroller::class, 'cashierstudentfee']);
Route::get('proofofpayment', [Pagecontroller::class, 'proofofpayment']);

Route::get('/proofofpayment/{id}', [Usercontroller::class, 'proofofpayment']);
Route::post('/proofofpayment/{id}', [Datacontroller::class, 'approvePayment']);


Route::get('cashierprofile', [Pagecontroller::class, 'cashierprofile']);

//admin
Route::get('admin', [Pagecontroller::class, 'admin']);
Route::get('adminmanageclassload', [Pagecontroller::class, 'adminmanageclassload'])->middleware('auth');

Route::get('adminusers', [Pagecontroller::class, 'adminusers']);
Route::post('adminusers', [Datacontroller::class, 'adminuserspost']);

Route::get('adminimportuser', [Pagecontroller::class, 'adminimportuser']);
Route::post('adminimportuser', [Datacontroller::class, 'CoreUsersImport']);


Route::get('adminnotification', [Pagecontroller::class, 'adminnotification']);

Route::get('adminstudent', [Pagecontroller::class, 'adminstudent']);
Route::post('adminstudent', [Datacontroller::class, 'UsersImportExcel']);

Route::get('adminreport', [Pagecontroller::class, 'adminreport']);
Route::get('adminprofile', [Pagecontroller::class, 'adminprofile']);

Route::get('oldstudent', [Pagecontroller::class, 'oldstudent']);
Route::post('oldstudent', [Datacontroller::class, 'oldstudentpost']);

Route::get('oldstudentprofile', [Pagecontroller::class, 'oldstudentprofile'])->middleware('auth');

Route::get('oldstudentdashboard', [Pagecontroller::class, 'oldstudentdashboard'])->middleware('auth');

Route::get('oldstudentaddress', [Pagecontroller::class, 'oldstudentaddress']);
Route::post('oldstudentaddress', [Datacontroller::class, 'oldstudentaddresspost']);
Route::get('oldstudentaddress/{registerFormId}', [Usercontroller::class, 'oldstudentaddress']);

Route::get('oldstudentprevious', [Pagecontroller::class, 'oldstudentprevious']);
Route::post('oldstudentprevious', [Datacontroller::class, 'oldstudentpreviouspost']);
Route::get('oldstudentupdateprevious/{id}', [Usercontroller::class, 'oldstudentupdateprevious'])->name('oldstudentupdateprevious.id');

Route::get('oldstudentdocuments', [Pagecontroller::class, 'oldstudentdocuments']);
Route::post('oldstudentdocuments', [Datacontroller::class, 'oldstudentdocumentspost']);

Route::get('oldstudentpayment', [Pagecontroller::class, 'oldstudentpayment']);
Route::post('oldstudentpayment', [Datacontroller::class, 'oldstudentpaymentpost']);

Route::get('oldstudentupdatedetails', [Pagecontroller::class, 'oldstudentupdatedetails']);
Route::get('oldstudentupdatedetails/{id}', [Usercontroller::class, 'oldstudentupdatedetails'])->name('oldstudentupdatedetails.id');
Route::post('oldstudentupdatedetails', [Datacontroller::class, 'oldstudentupdatedetailspost'])->middleware('auth');

Route::get('oldstudentupdateaddress', [Pagecontroller::class, 'oldstudentupdateaddress'])->middleware('auth');
Route::post('oldstudentupdateaddress', [Datacontroller::class, 'oldstudentupdateaddresspost'])->middleware('auth');
Route::get('/oldstudentupdateaddress/{id}', [Usercontroller::class, 'oldstudentupdateaddress'])->name('oldstudentupdateaddress.id');


Route::get('oldstudentupdateprevious', [Pagecontroller::class, 'oldstudentupdateprevious']);
Route::post('oldstudentupdateprevious', [Datacontroller::class, 'oldstudentupdatepreviouspost']);
Route::get('oldstudentupdateprevious/{id}', [Usercontroller::class, 'oldstudentupdateprevious'])->name('oldstudentupdateprevious.id');

Route::get('oldstudentupdatedocuments', [Pagecontroller::class, 'oldstudentupdatedocuments'])->middleware('auth');
Route::post('oldstudentupdatedocuments', [Datacontroller::class, 'oldstudentupdatedocumentspost'])->name('oldstudentupdatedocumentspost')->middleware('auth');



Route::get('oldstudentclassload', [Pagecontroller::class, 'oldstudentclassload'])->middleware('auth');

Route::get('oldstudentgrades', [PageController::class, 'oldstudentgrades'])->middleware('auth');

Route::get('/report-card/{core_id}/{grade_id}/{attendance_id}', [PDFController::class, 'downloadReportCard'])
    ->name('report.card.download');

Route::get('oldstudentassessment', [Pagecontroller::class, 'oldstudentassessment']);

Route::get('oldstudentenrollment', [Pagecontroller::class, 'oldstudentenrollment'])->name('oldstudentenrollment');

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
Route::post('/updatedocuments', [Datacontroller::class, 'updateDocuments'])->name('updateDocuments');



//delete image
Route::delete('/documents/{id}', [Datacontroller::class, 'destroy']);


Route::get('updateschool', [Pagecontroller::class, 'updateschool'])->middleware('auth')->name('updateschool');
Route::post('updateschool', [Datacontroller::class, 'updateschoolpost'])->middleware('auth');
Route::get('updateschool/{id}', [UserController::class, 'updateschool'])->middleware('auth')->name('updateschool.id');


Route::get('/grades/template', [Datacontroller::class, 'downloadTemplate'])->name('grades.template');
Route::post('/grades/import', [Datacontroller::class, 'importGrades'])->name('grades.import');


Route::get('/forgotpassword', [Pagecontroller::class, 'forgotpassword']);

Route::get('/resetpassword', [Pagecontroller::class, 'resetpassword']);


Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/password/reset/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [AuthController::class, 'resetPassword'])->name('password.update');

Route::get('/studenteditprofile', [Usercontroller::class, 'studenteditprofile'])->name('profile.update');
Route::get('teacherdisplaygrade/{edpcode}', [PageController::class, 'teacherdisplaygrade'])->name('display.grade');


Route::get('/oldstudentupdateprofile', [Pagecontroller::class, 'oldstudentupdateprofile'])->middleware('auth');

Route::post('/oldstudentupdateprofile', [Datacontroller::class, 'oldstudentupdateprofilepost'])->middleware('auth');


Route::get('/recordupdateprofile', [Pagecontroller::class, 'recordupdateprofile'])->middleware('auth');
Route::post('/recordupdateprofile', [Datacontroller::class, 'recordupdateprofilepost'])->middleware('auth');

Route::get('/studentupdateprofile', [Pagecontroller::class, 'studentupdateprofile'])->middleware('auth');
Route::post('/studentupdateprofile', [Datacontroller::class, 'studentupdateprofilepost'])->middleware('auth');

Route::get('/principalupdateprofile', [Pagecontroller::class, 'principalupdateprofile'])->middleware('auth');
Route::post('/principalupdateprofile', [Datacontroller::class, 'principalupdateprofilepost'])->middleware('auth');


Route::get('/accountingupdateprofile', [Pagecontroller::class, 'accountingupdateprofile'])->middleware('auth');
Route::post('/accountingupdateprofile', [Datacontroller::class, 'accountingupdateprofilepost'])->middleware('auth');
