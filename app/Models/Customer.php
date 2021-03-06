<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    protected $table = 'Customers';
    public $primaryKey = 'customer_id';
    protected $fillable = ['customer_id', 'name', 'email', 'company', 'address', 'phone_number', 'state', 'zip', 'country', 'notes', 'created_at', 'updated_at'];
    protected $guarded = array();

    public function invoice()
    {
    	return $this->hasMany('App\Models\Invoice');
    }
}
