<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Balance_Sheet_Accounts;
use App\General_Ledger_Transactions;
use App\Transaction_List;
use Carbon\Carbon;

function addNewEntry($date, $desc, $acc_name, $tx_amnt, $tx_type, $acc_norm, $acc_type)
{

    $tx_id = $this->addNewTransaction();

    $tx = new General_Ledger_Transactions;
	$tx->date = $date;
	$tx->transaction = $desc;
	$tx->account_name = $acc_name;
	$tx->transaction_amount = $tx_amnt;
	$tx->transaction_type = $tx_type;
	$tx->account_normal_balance = $acc_norm;
	$tx->account_type = $acc_type;
	$tx->tx_id = $tx_id;
	//return $tx;
	$tx->save();

	$this->updateAccountBalance($tx_amnt, $tx_type, $acc_name);
}