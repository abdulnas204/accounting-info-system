<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends BaseModel
{
    //
    protected $table = 'invoices';
    public $primaryKey = 'invoice_id';
    protected $fillable = ['invoice_id', 'name', 'amount', 'due_date', 'email', 'company', 'address', 'customer_id', 'order_id', 'description', 'created_at', 'updated_at'];

    public function findCustomerDetails()
    {
    	return $this->belongsTo('App\Models\Customer');
    }
    public function findInvoiceDetails()
    {
    	return $this->hasMany('App\Models\InvoiceDetails', 'invoice_id', 'invoice_id');
    }

    public static function boot()
    {
        parent::boot();
    }
}
