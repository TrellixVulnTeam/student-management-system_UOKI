<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


if(version_compare(PHP_VERSION, '7.2.0', '>=')) {
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
}


Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/success', function () {
    return view('auth.success');
})->name('auth.success');


//Management
Route::resource('/students', 'StudentController');
Route::post('/students/filter', 'StudentController@filter')->name('students.filter');

Route::resource('/enrolment', 'RegistrationController');
Route::post('/enrolment/filter', 'RegistrationController@filter')->name('enrolment.filter');
Route::get('enrolment/show-form/{student_id}', 'RegistrationController@showEnrollmentScreen')->name('enrolment.showEnrollmentScreen');

Route::resource('/enrolment-adjustment', 'EnrolmentAdjustmentController');
Route::post('/enrolment-adjustment/filter', 'EnrolmentAdjustmentController@filter')->name('enrolment.adjustment.filter');
Route::get('enrolment-adjustment/show-form/{student_id}', 'EnrolmentAdjustmentController@showEnrollmentScreen')->name('enrolment.adjustment.showScreen');

Route::resource('/cancel-registration', 'CancelRegistrationController');
Route::post('/cancel-registration/filter', 'CancelRegistrationController@filter')->name('cancel-registration.filter');
Route::get('cancel/show-form/{student_id}', 'CancelRegistrationController@showCancellationScreen')->name('cancellation.showCancellationScreen');
Route::get('cancel/form/{id}', 'CancelRegistrationController@edit')->name('cancel-subject.edit');
Route::post('cancel/form/{id}', 'CancelRegistrationController@store')->name('cancellation.store');
Route::get('cancel/remove/{student_id}/{module_id}', 'CancelRegistrationController@removeCancellation')->name('cancellation.remove');

//Finance
Route::resource('/invoices', 'InvoiceController');
Route::post('/invoices/filter', 'InvoiceController@filter')->name('invoices.filter');
Route::get('/invoices/print/{student_id}', 'InvoiceController@print')->name('invoices.print');

Route::resource('/payments', 'PaymentController');
Route::post('/payments/filter', 'PaymentController@filter')->name('payments.filter');

Route::resource('/debit-memos', 'DebitMemoController');
Route::post('/debit-memos/filter', 'DebitMemoController@filter')->name('debit-memos.filter');

Route::resource('/credit-memos', 'CreditMemoController');
Route::post('/credit-memos/filter', 'CreditMemoController@filter')->name('credit-memos.filter');

//Reports
Route::get('/student/reports', 'StudentReportController@index')->name('reports.students.index');
Route::post('/student/reports/search','StudentReportController@search')->name('reports.students.search');
Route::get('/student/reports/export', 'StudentReportController@export')->name('reports.students.export');

Route::get('/payment/reports', 'PaymentReportController@index')->name('reports.payments.index');
Route::post('/payment/reports/search', 'PaymentReportController@search')->name('reports.payments.search');
Route::get('/payment/reports/export', 'PaymentReportController@export')->name('reports.payments.export');

Route::get('/accounting/reports', 'InvoiceReportController@index')->name('reports.finance.index');
Route::post('/accounting/reports/search', 'InvoiceReportController@search')->name('reports.finance.search');
Route::get('/accounting/reports/export', 'InvoiceReportController@export')->name('reports.finance.export');

Route::get('/account-summary/reports', 'AccountSummaryController@index')->name('reports.account-summary.index');
Route::post('/account-summary/reports/search', 'AccountSummaryController@search')->name('reports.account-summary.search');
Route::get('/account-summary/reports/export', 'AccountSummaryController@export')->name('reports.account-summary.export');

Route::get('/aging/reports', 'InvoiceReportController@agingReport')->name('reports.finance.aging');
Route::get('/aging/reports/export', 'InvoiceReportController@export')->name('reports.aging.export');

Route::get('/audit/reports', 'AuditReportController@index')->name('reports.audit');
Route::get('/audit/show/{id}', 'AuditReportController@show')->name('reports.audit.show');
Route::post('/audit/reports/search', 'AuditReportController@search')->name('reports.audit.search');

//Ajax URLs
Route::get('get-subjects', 'HomeController@fetchSubjects');

//LMS setups
Route::resource('/subjects', 'ModuleController');
Route::resource('/company', 'CompanySetupController');
Route::resource('/fees', 'FeesController');
Route::resource('/centers', 'CenterController');
Route::resource('/academic-year', 'AcademicYearController');
Route::get('/academic-year/status/{id}', 'AcademicYearController@updateStatus')->name('academic-year.status');

//Access Management
Route::resource('/users','UsersController');

Route::get('/start-page', function(){
    return view('start-page');
});
// Route::get('richard', function(){
//     return phpinfo();
// });

