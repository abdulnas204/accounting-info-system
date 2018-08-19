<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends BaseModel
{
    //
    protected $table = "sales";
    public $primaryKey = 'sale_id';

    public static function boot()
    {
        parent::boot();
    }
}
