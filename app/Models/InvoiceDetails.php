<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceDetails extends Model
{
    //
    protected $table = "InvoiceDetails";
    public $primaryKey = 'invoice_detail_id';
    protected $fillable = ['item_detail_id', 'item', 'quantity', 'price', 'invoice_id', 'unit', 'total_value', 'created_at', 'updated_at'];
}
