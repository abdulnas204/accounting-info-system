<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\General_Ledger_Transactions;
use App\Transaction_List;

class PageController extends Controller
{
    // Main menu
    public function getIndex()
    {
    	return view('pages.index');
    }

    // View/edit the general ledger
    public function getLedger()
    {
        //$accounts = new General_Ledger_Transactions;
        $accounts = General_Ledger_Transactions::paginate(100);
        //$current_num = $accounts->
        $transactions = Transaction_List::all()->toArray();
        $transaction = [];
        foreach($transactions as $tx){
            if(empty(Transaction_List::find($tx['id'])->transaction->toArray())){
                continue;
            }
            $transaction[$tx['id']] = Transaction_List::find($tx['id'])->transaction->toArray();
        }
    	return view('pages.ledger')->with('accounts', $transaction);
        //return view('pages.ledger')->with('accounts', $transactions);
    }

    // Administrative page
    public function getAdminPage()
    {
    	return view('pages.admin');
    }

    // Sub menu view for various fin statements
    public function getFinancialStatements()
    {
    	return view('pages.compose');
    }

    // Compose & view balance sheet
    public function showBalanceSheet()
    {
    	return view('pages.balancesheet');
    }
}