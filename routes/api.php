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
Route::get('login', 'Auth\LoginController@loginAPI');
Route::middleware('api_auth')->group(function (){
    Route::prefix('transaction')->group(function (){
        Route::post( '/', 'SearchTransactionAPIController@search');
        Route::delete('/{transaction_id}', 'TransactionAPIController@delete');
        Route::put('/{transaction_id}', 'TransactionAPIController@update');
    });

    Route::prefix('customer')->group(function (){
        Route::get('/{customerId}/transaction/{transaction_id}', 'TransactionAPIController@show');
        Route::post('/{customerId}/transaction', 'TransactionAPIController@create');
        Route::post('/', 'CustomerAPIController@create');

    });
});
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
