<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransactionData;
use App\Models\Transaction;

class PageController extends Controller
{
    // Main menu
    public function getIndex()
    {
        
        return view('pages.index');
    }
    // View customers full page -- there will be an option to add customers from other pages, which will reference this API
    /*public function getCustomerPage()
    {
        return view('pages.customer.index');
    }*/

    // View/edit the general ledger
    public function getLedger()
    {
        //$accounts = new General_Ledger_Transactions;
        $accounts = TransactionData::paginate(100);
        //$current_num = $accounts->
        $transactions = Transaction::all()->toArray();
        $transaction = [];
        foreach($transactions as $tx){
            if(empty(Transaction::find($tx['transaction_id'])->transaction->toArray())){
                continue;
            }
            $transaction[$tx['transaction_id']] = Transaction::find($tx['transaction_id'])->transaction->toArray();
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

    public function getLogin()
    {
        return view('pages.auth.login');
    }

    public function getRegister()
    {
        return view('pages.auth.register');
    }
}
