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
    return view('welcome');
});

Route::get('/load/{profile}/{section}', 'ProfilesController@loadEditSection');
Route::get('/detach/{profile}/{section}', 'ProfilesController@detach');
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

//Finance
Route::resource('/invoices', 'InvoiceController');
Route::post('/invoices/filter', 'InvoiceController@filter')->name('invoices.filter');
Route::resource('/payments', 'PaymentController');
Route::post('/payments/filter', 'PaymentController@filter')->name('payments.filter');
Route::resource('/statements', 'StatementController');
Route::post('/statements/filter', 'StatementController@filter')->name('statements.filter');

//Reports
Route::get('/student/reports', 'StudentReportController@index');
Route::get('/invoice/reports', 'InvoiceReportController@index');
Route::get('/payment/reports', 'PaymentReportController@index');

//LMS setups
Route::resource('/subjects', 'SubjectController');
Route::resource('/fees', 'FeesController');
Route::resource('/centers', 'CenterController');

