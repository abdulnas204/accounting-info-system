<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaxOptions extends BaseModel
{
    //
    protected $table = 'taxes';
    public $primaryKey = 'tax_id';

    public static function boot()
    {
        parent::boot();
    }
}
