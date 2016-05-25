<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', function () {
	header('location:admin');
	die();
});



// admin routes
Route::get('/admin/', 'AdminController@showLogin')->name('login');
Route::get('/admin/logout', 'AdminController@logout');
Route::get('/admin/verify/{code}', 'AdminController@showPasswordReset');


//secure view routes
Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
	Route::get('users', 'AdminController@showUser');
	Route::get('security', 'AdminController@showSecurity');
	Route::get('security/modules', 'AdminController@showModules');
	Route::get('contacts', 'AdminController@showContacts');
	Route::get('contacts/roles', 'AdminController@showContactsRoles');
	Route::get('receipt/cat-items', 'AdminController@showCatItems');
	Route::get('receipt', 'AdminController@showReceipt');
});


// Non secure routes
Route::group(['prefix' => 'api'], function () {
	Route::post('job', 'JobController@save');
	Route::post('auth/login', 'AuthController@login');
	Route::post('auth/password_request', 'AuthController@forgotPasswordReq');
	Route::post('auth/reset_password', 'AuthController@resetPassword');
});

//Secure routes
Route::group(['prefix' => 'api'], function () {

	// Usermodule routes
	Route::get('user', 'UserController@all');
	Route::delete('user/{id}', 'UserController@destroy');
	Route::post('user/', 'UserController@save');
	Route::get('user/{id}', 'UserController@get');
	Route::put('user/{id}', 'UserController@update');

	// Module routes
	Route::get('module', 'ModuleController@all');
	Route::delete('module/{id}', 'ModuleController@destroy');
	Route::post('module/', 'ModuleController@save');
	Route::post('module/userperm/{id}', 'ModuleController@getUserPerm');
	Route::put('module/userperm/{id}', 'ModuleController@saveUserPerm');
	Route::get('module/{id}', 'ModuleController@get');
	Route::put('module/{id}', 'ModuleController@update');

	//contact roles
	Route::get('contact/roles', 'ContactRoleController@all');
	Route::delete('contact/roles/{id}', 'ContactRoleController@destroy');
	Route::post('contact/roles', 'ContactRoleController@save');
	Route::get('contact/roles/{id}', 'ContactRoleController@get');
	Route::put('contact/roles/{id}', 'ContactRoleController@update');

	// Payment mode 
	Route::get('payment_mode', 'PaymentModeController@all');
	Route::delete('payment_mode/{id}', 'PaymentModeController@destroy');
	Route::post('payment_mode', 'PaymentModeController@save');
	Route::get('payment_mode/{id}', 'PaymentModeController@get');
	Route::put('payment_mode/{id}', 'PaymentModeController@update');

	// Contacts
	Route::get('contact', 'ContactController@all');
	Route::get('contact/nric', 'ContactController@checkDuplicate');
	Route::get('contact/contact_roles/{id}', 'ContactRoleController@getAllContactRoles');
	Route::put('contact/contact_roles/{id}', 'ContactRoleController@saveAllContactRoles');
	Route::delete('contact/{id}', 'ContactController@destroy');
	Route::post('contact/', 'ContactController@save');
	Route::get('contact/{id}', 'ContactController@get');
	Route::put('contact/{id}', 'ContactController@update');

	//receipt cat items routes
	Route::get('receipt/cat-items', 'CatItemController@all');
	Route::delete('receipt/cat-items/{id}', 'CatItemController@destroy');
	Route::post('receipt/cat-items', 'CatItemController@save');
	Route::get('receipt/cat-items/{id}', 'CatItemController@get');
	Route::put('receipt/cat-items/{id}', 'CatItemController@update');

	Route::get('receipt', 'ReceiptController@all');
	Route::delete('receipt/{id}', 'ReceiptController@destroy');
	Route::post('receipt', 'ReceiptController@save');
	Route::get('receipt/{id}', 'ReceiptController@get');
	Route::put('receipt/{id}', 'ReceiptController@update');



});










//secure api routes



Route::auth();

Route::get('/home', 'HomeController@index');
