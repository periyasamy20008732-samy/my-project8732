<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    //
    protected $table = "orders_items";
    protected $fillable = [
        'order_id',
        'user_id',
        'store_id',
        'item_id',
        'selling_price',
        'qty',
        'tax_rate',
        'tax_type',
        'tax_amt',
        'total_price',
        'if_offer'
    ];
}