<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchasePaymentReturn extends Model
{
    protected $table = "purchase_payment_returns";
    protected $fillable = [
        'count_id',
        'payment_code',
        'store_id',
        'purchase_id',
        'return_id',
        'payment_date',
        'payment_type',
        'payment',
        'payment_note',
        'status',
        'account_id',
        'supplier_id',
        'short_code',
        'created_by'
    ];
}