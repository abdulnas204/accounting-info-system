<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    //
    protected $table = 'Invoices';
    public $primaryKey = 'invoice_id';
    protected $fillable = ['invoice_id', 'name', 'amount', 'due_date', 'email', 'company', 'address', 'customer_id', 'order_id', 'description', 'created_at', 'updated_at'];

    public function findCustomerDetails()
    {
    	return $this->belongsTo('App\Models\Customer');
    }
}
