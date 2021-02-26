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

//=================
Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');


Route::group(['middleware' => 'auth:api'], function(){
	Route::post('details', 'API\UserController@details');
});
//===================
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('profile', 'API\UserController@profile');
Route::post('cust_master','API\CustomerMasterController@store');
Route::post('inv_master','API\InvoiceMastersController@store');
Route::post('voucher_master','API\VouchersController@store');
Route::get('voucher_master', 'PaymentGatewayController@index');
Route::put('voucher_master', 'PaymentGatewayController@update')->name('paymentget.update');

