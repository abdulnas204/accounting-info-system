<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends BaseModel
{
    //
    protected $table = 'vendors';
    public $primaryKey = 'vendor_id';

    public static function boot()
    {
        parent::boot();
    }
}
