<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryItems extends BaseModel
{
    //
    protected $table = 'inventory_items';
    public $primaryKey = 'item_id';

    public static function boot()
    {
        parent::boot();
    }
}
