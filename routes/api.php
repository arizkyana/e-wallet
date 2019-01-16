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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'topup'], function(){

    Route::get('/', function(){
        return response(['message' => 'topup endpoint']);
    });

    Route::post('/wallet/{user}', 'Api\TopUpController@walletByUser');
    Route::post('/checkout', 'Api\TopUpController@checkout');
    Route::post('/submit', 'Api\TopUpController@submit');
    Route::post('/confirm', 'Api\TopUpController@submit');
});