<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryItems extends Model
{
    //
    protected $table = 'inventory_items';
    public $primaryKey = 'item_id';
}
