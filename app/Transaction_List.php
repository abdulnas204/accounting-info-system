<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction_List extends Model
{
    //
    protected $table = "Transaction_List_Table";
    //protected $primaryKey = 'id';

    public function transaction()
    {
    	//$this->primaryKey = 'account_name';
    	return $this->hasMany("App\General_Ledger_Transactions", 'tx_id', 'id');
    }
}
