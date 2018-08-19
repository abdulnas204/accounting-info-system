<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends BaseModel
{
    //
    protected $table = "transactions";
    //protected $primaryKey = 'id';
    public $primaryKey = 'transaction_id';

    public function transaction()
    {
    	//$this->primaryKey = 'account_name';
    	return $this->hasMany("App\Models\TransactionData", 'tx_id', 'transaction_id');
    }

    public static function boot()
    {
        parent::boot();
    }
}
