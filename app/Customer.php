<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    protected $table = 'Customers';
    protected $fillable = ['id', 'name', 'email', 'company', 'address', 'phone_number', 'state', 'zip', 'country', 'created_at', 'updated_at'];
    protected $guarded = array();
}
