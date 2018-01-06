<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Balance_Sheet_Accounts extends Model
{
    //
    protected $table = "Balance_Sheet_Table";
    public $primaryKey = 'account_name';
    public $incrementing = false;
    //protected $primaryKey;

    public function account()
    {
    	//$this->primaryKey = 'account_name';
    	return $this->hasMany("App\General_Ledger_Transactions", 'account_name', 'account_name');
    }
    /*public function listAccounts()
    {
    	return $this->all();
    }*/


}
