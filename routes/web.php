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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

 Route::get('/sale_sub', 'HomeController@sale_sub')->name('home.sale_sub');
 Route::get('/getsubs', 'HomeController@getsubs')->name('home.getsubs');

Route::get('/invoices', 'HomeController@invoices')->name('home.invoices');
Route::get('/getinvoices', 'HomeController@getinv')->name('home.getinvoices');
Route::get('/item_details/{id?}', 'HomeController@getItemDetailsSingleData')->name('home.item_details');

Route::get('/payments', 'HomeController@payments')->name('home.payments');
Route::get('/getpayments', 'HomeController@getpayments')->name('home.getpayments');
Route::get('/voucher_details/{id?}', 'HomeController@getVoucherDetailsSingleData')->name('home.voucher_details');


Route::get('/invoices', 'HomeController@invoices')->name('home.invoices');
Route::get('/print_invoice/{id?}', 'HomeController@print_invoice')->name('home.print_invoice');

Route::get('/passalert', 'HomeController@index')->name('home.passalert');

Route::get('/getcount', 'HomeController@deshboard_count')->name('home.deshboard_count');

Route::get('register/profile/{id?}', 'Auth\RegisterController@edit')->name('register.profile');
Route::patch('register/{user}/update', 'Auth\RegisterController@update')->name('profile.update');

//Route::post('payments_responce', 'PaymentGatewayController@store');
Route::get('/paymentget/{id}/{balance}', 'PaymentGatewayController@create')->name('pay.paymentget');

Route::get('/paymentget/checkout', 'PaymentGatewayController@checkout')->name('pay.paymentget.checkout');
Route::post('/invpaymentget', 'PaymentGatewayController@pay_invlst_create')->name('pay.invpaymentget');

  Route::post('paymentget/payment-status', 'PaymentGatewayController@paymentStatus')->name('pay.payment-status');
  Route::post('paymentget/payment-cancel', 'PaymentGatewayController@paymentCancel')->name('pay.payment-cancel');

Route::get('/advpaymentget', 'PaymentGatewayController@adv_pay')->name('pay.advpaymentget');
Route::post('/advpaymentget', 'PaymentGatewayController@advpay_create')->name('pay.advpaymentget');


  Route::get('/paymentget/unregisterpayment', 'UnRegisterPaymentController@index')->name('pay.unregister');
    Route::post('/paymentget/unregisterpayment', 'UnRegisterPaymentController@create')->name('pay.unregister');
  Route::post('paymentget/unregisterpayment-status', 'UnRegisterPaymentController@paymentStatus');
  Route::post('paymentget/unregisterpayment-cancel', 'UnRegisterPaymentController@paymentCancel');
  
  Route::get('/send', 'CommonController@send');

Route::group(['namespace'=>'Admin'], function(){
Route::get('admin-login', 'Auth\LoginController@showLoginForm')->name('admin.login');
Route::post('admin-login', 'Auth\LoginController@login');
Route::get('admin/home','HomeController@index')->name('admin.home');
//Route::post('logout', 'Admin\Auth\LoginController@logout')->name('logout');

Route::get('admin/sale_sub', 'HomeController@sale_sub')->name('admin.home.sale_sub');
 Route::get('admin/getsubs', 'HomeController@getsubs')->name('admin.home.getsubs');
Route::get('admin/invoices', 'HomeController@invoices')->name('admin.home.invoices');
Route::get('admin/getinvoices', 'HomeController@getinv')->name('admin.home.getinvoices');
Route::get('admin/print_invoice/{id?}', 'HomeController@print_invoice')->name('admin.home.print_invoice');

Route::get('admin/item_details/{id?}', 'HomeController@getItemDetailsSingleData')->name('admin.home.item_details');
Route::get('admin/payments', 'HomeController@payments')->name('admin.home.payments');
Route::get('admin/getpayments', 'HomeController@getpayments')->name('admin.home.getpayments');


Route::get('admin/unregisterpayments', 'HomeController@show')->name('admin.unregisterpayments');
Route::get('admin/getunregisterpayments', 'HomeController@getunregisterpayments')->name('admin.home.getunregisterpayments');

Route::get('admin/voucher_details/{id?}', 'HomeController@getVoucherDetailsSingleData')->name('admin.home.voucher_details');

});
