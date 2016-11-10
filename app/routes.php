<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array('uses'=>'HomeController@getIndex'));
Route::controller('users', 'UsersController');
Route::controller('client', 'ClientController');


//admin view
Route::controller('admin', 'AdminController');

//Ws view
Route::controller('api/v1', 'WsController');



Route::post('payment', array(
    'as' => 'payment',
    'uses' => 'ClientController@postPayment',
));

// this is after make the payment, PayPal redirect back to your site
Route::get('payment/status', array(
    'as' => 'payment.status',
    'uses' => 'ClientController@getPaymentStatus',
));
