<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends BaseModel
{
    //
    protected $table = 'purchases';
    public $primaryKey = 'purchase_id';

    public static function boot()
    {
        parent::boot();
    }
}
