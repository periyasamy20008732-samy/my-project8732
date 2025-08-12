<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnlinePayment extends Model
{
    //
    use HasFactory;

    protected $table = 'online_payment';

    protected $fillable = [
        'user_id',
        'order_id',
        'payment_id',
        'gateway',
        'price',
        'tax',
        'tax_amount',
        'price_tax',
        'payment_status',
        'status',

    ];
}
