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

//Routes for customers
Route::post('customer/preview', 'CustomerController@retrieveCustomerPreview');
Route::resource('customer', 'CustomerController');

Route::post('inventory/preview', 'InventoryController@retrieveInventoryPreview');
Route::resource('inventory', 'InventoryController');
//Routes for invoices
Route::get('invoice/{id}/print', 'InvoiceController@print');
Route::post('/invoice/{id}/paid', 'InvoiceController@togglePaid');
Route::resource('invoice', 'InvoiceController');

//Routes for vendors
Route::post('vendor/search', 'VendorController@searchVendors');
Route::post('vendor/preview', 'VendorController@retrieveVendorPreview');
Route::resource('vendor', 'VendorController');



Route::resource('sale', 'SaleController');

Route::resource('bill', 'BillController');

// Route::resource('setting', 'SettingController');
// Route::get('setting', 'SettingController@index');
Route::get('setting/home', 'SettingController@home');

Route::get('setting/general', 'SettingController@general');
Route::post('setting/general/{id}/update', 'SettingController@updateGeneral');

Route::get('setting/reports', 'SettingController@reports');
Route::get('setting/taxes', 'SettingController@taxes');
Route::post('setting/taxes/add', 'SettingController@addTax');
Route::get('setting/localization', 'SettingController@localization');

Route::post('purchase/{id}/paid', 'PurchaseController@togglePaid');
Route::resource('purchase', 'PurchaseController');


/* API Interface */
//Route::resource('ledger', 'LedgerController');
Route::get('/ledger/accounts/show', 'LedgerController@showAccounts');
Route::post('/ledger/accounts/add', 'LedgerController@addAccount');
Route::post('/ledger/accounts/remove', 'LedgerController@removeAccount');
Route::put('/ledger/accounts/update', 'LedgerController@updateAccount');
Route::post('/ledger/accounts/flush', 'LedgerController@flushNominalAccounts');

// Route::post('/ledger/accounts/add-invoice', 'LedgerController@addNewEntry');



Route::get('/help', 'HelpController@index');



// REST API Endpoints
Route::post('/api/tax/{id}/get', 'TaxController@getTax');
Route::get('/api/tax/all', 'TaxController@all');





//Test environment
Route::get('/ledger/accounts/test', 'LedgerController@test');
Route::get('/ledger/accounts/testjs', 'LedgerController@testJs');
