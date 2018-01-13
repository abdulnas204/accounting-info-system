<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class General_Ledger_Transactions extends Model
{
    //
    protected $table = "General_Ledger_Table";
    protected $primaryKey = 'entry_id';
    //public $foreignKey = 'account_name';
    //public $incrementing = false;

    public function account()
    {
    	$foreignKey = 'tx_id';
    	return $this->belongsTo('App\Balance_Sheet_Accounts', 'account_name', 'account_name');
    }
}
