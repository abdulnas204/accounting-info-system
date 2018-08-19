<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends BaseModel
{
    //
    protected $table = 'customers';
    public $primaryKey = 'customer_id';
    protected $fillable = ['customer_id', 'name', 'email', 'company', 'address', 'phone_number', 'state', 'zip', 'country', 'notes', 'created_at', 'updated_at', 'user_id'];
    protected $guarded = array();

    public function invoice()
    {
    	return $this->hasMany('App\Models\Invoice', 'customer_id');
    }

    public static function boot()
    {
        parent::boot();
    }
}
