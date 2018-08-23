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
Auth::routes();

Route::middleware('auth')->group(function (){
    Route::get('/', function () {
        return redirect('transaction');
    });
    Route::prefix('transaction')->group(function (){
        Route::match(['get', 'post'], '/', 'SearchTransactionGUIController@search')->name('search');
        Route::delete('/{transaction_id}', 'TransactionGUIController@delete')->name('delete_transaction');
        Route::put('/{transaction_id}', 'TransactionGUIController@update')->name('update_transaction');
    });

    Route::prefix('customer')->group(function (){
        Route::get('/{customerId}/transaction/{transaction_id}', 'TransactionGUIController@show')->name('get_transaction');
        Route::post('/{customerId}/transaction', 'TransactionGUIController@create')->name('create_transaction');
        Route::get('/{customerId}/transaction', function ($id){
            return view('transaction.create', ['customer_id'=>$id]);
        })->name('create_transaction_view');
        Route::post('/', 'CustomerGUIController@create')->name('create_customer');
        Route::get('/', 'CustomerGUIController@show');
        Route::get('/create', function (){
            return view('customer.create');
        })->name('customer_create');
    });
});


