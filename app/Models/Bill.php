<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends BillModel
{
    //
    protected $table = "bills";
    public $primaryKey = 'bill_id'; 


    public static function boot()
    {
        parent::boot();
    }
}
