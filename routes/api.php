<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::namespace('API')->group(function () {
	Route::post('user/login', 'UserController@login');

	Route::group(['middleware' => 'auth:api'], function () {
		Route::get('user/logout', 'UserController@logout');
		// USERS
	    Route::resource('user', 'UserController');
	    Route::get('users', 'UserController@all');
	    Route::post('user/change-password', 'UserController@change_password');

	    //ROLES
	    Route::resource('role', 'RoleController');

	    //EXPENSES CATEGORIES
	    Route::resource('expenses-category', 'ExpenseCategoryController');

	    //EXPENSES
	    Route::resource('expense', 'ExpenseController');
	    Route::get('expenses', 'ExpenseController@all');
    });
});