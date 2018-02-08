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

Route::get('/', 'PageController@getIndex');
Route::get('/ledger', 'PageController@getLedger');

Route::get('/compose', 'PageController@getFinancialStatements');
Route::get('/compose/balance-sheet', 'PageController@showBalanceSheet');

//Route::get('/customer', 'PageController@getCustomerPage');

//REST API for customers
Route::resource('customer', 'CustomerController');
Route::post('customer/preview', 'CustomerController@retrieveCustomerPreview');

//REST API for invoices
Route::resource('invoice', 'InvoiceController');
Route::post('/invoice/{id}/paid', 'InvoiceController@togglePaid');

//REST API for invoices
Route::resource('vendor', 'VendorController');

Route::resource('sale', 'SaleController');

Route::resource('setting', 'SettingController');

Route::resource('purchase', 'PurchaseController');


/* API Interface */
//Route::resource('ledger', 'LedgerController');
Route::get('/ledger/accounts/show', 'LedgerController@showAccounts');
Route::post('/ledger/accounts/add', 'LedgerController@addAccount');
Route::post('/ledger/accounts/remove', 'LedgerController@removeAccount');
Route::put('/ledger/accounts/update', 'LedgerController@updateAccount');
Route::post('/ledger/accounts/flush', 'LedgerController@flushNominalAccounts');

// Route::post('/ledger/accounts/add-invoice', 'LedgerController@addNewEntry');








//Test environment
Route::get('/ledger/accounts/test', 'LedgerController@test');
Route::get('/ledger/accounts/testjs', 'LedgerController@testJs');
