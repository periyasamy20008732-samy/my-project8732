<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentTypes extends Model
{
    //
    protected $table = "paymenttypes";
    protected $fillable = [
        'store_id',
        'payment_type',
        'status'
    ];
}