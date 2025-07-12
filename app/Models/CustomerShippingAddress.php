<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerShippingAddress extends Model
{
    //
    protected $table = "customer_shippingaddress";
    protected $fillable = [
        'user_id',
        'customer_id',
        'store_id',
        'country_id',
        'state',
        'city',
        'postcode',
        'address',
        'location_link',
        'shipping_name',
        'status',
        'contact_no',
        'default'
    ];
}