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

Auth::routes();
Route::get('/', 'HomeController@index')->name('home');


Route::group(['middleware' => ['auth'] ], function () {

    Route::get('/profile', function () {
        return view('dashboard.profile');
    })->name('profile');



    Route::get('/reports', function () {
        return view('reports.index');
    })->name('reports');


    Route::get('/users', 'UserController@index')->name('users');
    Route::get('/users/admin', 'UserController@show')->name('users.admin');
    Route::post('/users/delete', 'UserController@delete')->name('delete.user');
    Route::post('/users/get', 'UserController@fetch')->name('get.user');
    Route::post('/users/edit', 'UserController@edit')->name('edit.user');
    Route::post('/users/update', 'UserController@update')->name('update.user');
    Route::post('/users/add', 'UserController@add')->name('add.user');
    Route::post('/users/admin/password', 'UserController@changePassword')->name('password.admin');

    Route::get('/students','StudentController@index')->name('students');
    Route::get('/students/admin','StudentController@show')->name('students.admin');
    Route::get('/students/admin/{status}', 'StudentController@show')->name('students.admin.status');
    Route::post('/students/add', 'StudentController@add')->name('add.student');
    Route::post('/students/get', 'StudentController@get')->name('get.student');
    Route::post('/students/update', 'StudentController@update')->name('update.student');
    Route::get('/students/{student}','StudentController@view')->name('view.student');

    Route::get('/costs/enrollments', 'CostController@enrollments')->name('costs.enrollments');
    Route::get('/costs/enrollments/fetch', 'EnrollmentController@fetch')->name('enrollments.fetch');
    Route::post('/costs/enrollments/delete', 'EnrollmentController@delete')->name('delete.enrollment');
    Route::post('/costs/enrollments/add', 'EnrollmentController@add')->name('add.enrollment');
    Route::post('/costs/enrollments/get', 'EnrollmentController@get')->name('get.enrollment');
    Route::post('/costs/enrollments/update', 'EnrollmentController@update')->name('update.enrollment');

    Route::get('/costs/services', 'CostController@services')->name('costs.services');
    Route::get('/costs/services/fetch', 'ServiceController@fetch')->name('services.fetch');
    Route::post('/costs/services/add', 'ServiceController@add')->name('add.service');
    Route::post('/costs/services/get', 'ServiceController@get')->name('get.service');
    Route::post('/costs/services/update', 'ServiceController@update')->name('update.service');
    Route::post('/costs/services/delete', 'ServiceController@delete')->name('delete.service');

    Route::get('/costs/annuites', 'CostController@annuites')->name('costs.annuites');
    Route::get('/costs/annuites/fetch', 'AnnuityController@fetch')->name('annuities.fetch');
    Route::post('/costs/annuites/add', 'AnnuityController@add')->name('add.annuity');
    Route::post('/costs/annuites/update', 'AnnuityController@update')->name('update.annuity');
    Route::post('/costs/annuites/get', 'AnnuityController@get')->name('get.annuity');
    Route::post('/costs/annuites/delete', 'AnnuityController@delete')->name('delete.annuity');

    Route::post('/contract/getenrollmentannuity', 'ContractController@dataCreateContract')->name('student.enrollmentAnnuity');
    Route::post('/contract/create', 'ContractController@create')->name('create.contract');
    Route::post('/contract/show', 'ContractController@show')->name('show.contract');
    Route::post('/contract/delete', 'ContractController@delete')->name('delete.contract');

    Route::post('/fee/update', 'FeeController@update')->name('update.fee');

    Route::get('/payments', 'PaymentController@show')->name('payments');
    Route::get('/payments/fetch', 'PaymentController@fetch')->name('fetch.payments');
    Route::get('/payments/add', 'PaymentController@add')->name('add.payments');

    Route::get('/payments/test', 'PaymentController@test')->name('test.payments');

});