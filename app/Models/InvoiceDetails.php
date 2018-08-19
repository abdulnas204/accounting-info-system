<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceDetails extends BaseModel
{
    //
    protected $table = "invoice_data";
    public $primaryKey = 'invoice_detail_id';
    protected $fillable = ['item_detail_id', 'item', 'quantity', 'price', 'invoice_id', 'unit', 'total_value', 'created_at', 'updated_at'];

    public static function boot()
    {
        parent::boot();
    }
}
