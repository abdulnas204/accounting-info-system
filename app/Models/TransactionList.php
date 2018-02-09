<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionList extends Model
{
    //
    protected $table = "TransactionList";
    //protected $primaryKey = 'id';
    public $primaryKey = 'transaction_id';

    public function transaction()
    {
    	//$this->primaryKey = 'account_name';
    	return $this->hasMany("App\Models\GeneralLedgerTransactions", 'tx_id', 'transaction_id');
    }
}
