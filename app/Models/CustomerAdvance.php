<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerAdvance extends Model
{
    //
    protected $table = "customer_advance";
    protected $fillable = [
        'store_id',
        'count_id',
        'payment_code',
        'payment_date',
        'customer_id',
        'amount',
        'payment_type',
        'note',
        'status'
    ];
}


