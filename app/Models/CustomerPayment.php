<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerPayment extends Model
{
    protected $table = "customer_payments";
    protected $fillable = [
        'salespayment_id',
        'customer_id',
        'payment_date',
        'payment_type',
        'payment',
        'payment_note',
        'status',
        'created_by'
    ];
}