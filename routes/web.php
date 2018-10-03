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

    Route::get('/students', function () {
        return view('students.index');
    })->name('students');


    Route::get('/payments', function () {
        return view('payments.index');
    })->name('payments');


    Route::get('/costs', function () {
        return view('costs.index');
    })->name('costs');


    Route::get('/reports', function () {
        return view('reports.index');
    })->name('reports');



    Route::get('/users', function () {
        return view('users.index');
    })->name('users')->middleware('isSuperAdmin');

    Route::get('/users/admin', 'UserController@show')->name('users.admin')->middleware('isSuperAdmin');

    Route::post('/delete/user', 'UserController@delete')->name('delete.user');
    Route::post('/edit/user', 'UserController@edit')->name('edit.user');

});