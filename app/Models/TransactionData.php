<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionData extends BaseModel
{
    //
    protected $table = "transactions_data";
    public $primaryKey = 'entry_id';
    //public $foreignKey = 'account_name';
    //public $incrementing = false;

    public function account()
    {
    	$foreignKey = 'tx_id';
    	return $this->belongsTo('App\Models\BalanceSheetAccount', 'account_name', 'account_name');
    }

    public static function boot()
    {
        parent::boot();
    }
}
