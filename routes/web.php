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



Route::get('error', ['as'=>'error','uses'=>'DashboardController@pageNotFound']);
Route::get('logout', ['as'=>'logout','uses'=>'DashboardController@logout']);

Route::resource('company','CompanyController');
Route::resource('subject','SubjectController');
Route::resource('grade','GradeController');
Route::resource('contractPeriod','ContractPeriodController');
Route::resource('user','UserController');

Route::post('checkUser', ['as'=>'checkUser','uses'=>'UserController@checkUser']);
Route::resource('book','BookController');
Route::get('usersBook', ['as'=>'usersBook','uses'=>'UserController@usersBook']);
Route::post('getUsersBooks', ['as'=>'getUsersBooks','uses'=>'UserController@getUsersBooks']);
Route::post('postUsersBooks', ['as'=>'postUsersBooks','uses'=>'UserController@postUsersBooks']);
Route::get('userListExcel/{type}', ['as'=>'userListExcel','uses'=>'UserController@userListExcel']);
Route::post('generatePassword', ['as'=>'generatePassword','uses'=>'UserController@randomPassword']);