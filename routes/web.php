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

    Route::get('/payments', function () {
        return view('payments.index');
    })->name('payments');



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

    Route::get('/costs/enrollments', 'CostController@enrollments')->name('costs.enrollments');
    Route::get('/costs/enrollments/fetch', 'CostController@fetch')->name('enrollments.fetch');

});