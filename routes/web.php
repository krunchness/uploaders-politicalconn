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

Route::get('/', function () {
    return redirect('login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function() {
    Route::get('/', 'DashboardController@index');
    Route::get('/files', 'DashboardController@showFilesTable')->name('file.list');
    Route::post('/files', 'DashboardController@uploadFile')->name('file.upload');

    Route::get('/user-management', 'UserController@usersList')->name('usermanagement.usersList');
    Route::post('/user-management', 'UserController@addUser')->name('usermanagement.addUser');
    Route::get('/role-management', 'UserController@rolesList')->name('usermanagement.rolesList');
    Route::post('/role-management', 'UserController@addRole')->name('usermanagement.addRole');
});
