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


/**
 * Wallet
 */
// topup
Route::get('/topup', 'TopUpController@index')->name('wallet.topup');
Route::post('/topup/checkout', 'TopUpController@checkout')->name('wallet.topup.checkout');
Route::post('/topup/submit', 'TopUpController@submit')->name('wallet.topup.submit');
Route::post('/topup/confirm', 'TopUpController@confirm')->name('wallet.topup.confirm');

// pay
Route::get('/pay', 'PayController@index')->name('wallet.pay');
Route::get('/pay/bill', 'PayController@bill')->name('wallet.pay.bill');
Route::post('/pay/submit', 'PayController@pay')->name('wallet.pay.submit');