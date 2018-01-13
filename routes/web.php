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

// Show sub menu page
Route::get('/compose', 'PageController@getFinancialStatements');
// Compose & show balance sheet
Route::get('/compose/balance-sheet', 'PageController@showBalanceSheet');


/* API Interface */
//Route::resource('ledger', 'LedgerController');
Route::get('/ledger/accounts/show', 'LedgerController@showAccounts');
Route::post('/ledger/accounts/add', 'LedgerController@addAccount');
Route::post('/ledger/accounts/remove', 'LedgerController@removeAccount');
Route::put('/ledger/accounts/update', 'LedgerController@updateAccount');
Route::get('/ledger/accounts/test', 'LedgerController@test');
Route::post('/ledger/accounts/flush', 'LedgerController@flushNominalAccounts');
