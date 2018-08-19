<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends BaseModel
{
    //
    protected $table = 'inventory';
    public $primaryKey = 'inventory_id';

    public static function boot()
    {
        parent::boot();
    }
}
