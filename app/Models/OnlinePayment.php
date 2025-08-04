<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnlinePayment extends Model
{
    //
    use HasFactory;

    protected $table = 'payment'; // only needed if the table is not 'payments'

    protected $fillable = [
        'user_id',
        'store_id',
        'item_id',
        'unique_order_id',
        'amount',
        'gateway',
        'status',
        'payment_id',
        'purpose',
    ];
}