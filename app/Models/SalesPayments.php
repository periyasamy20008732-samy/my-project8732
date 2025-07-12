<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesPayments extends Model
{
    protected $table = 'sales_payments';
    protected $fillable = [
        'count_id',
        'payment_code',
        'store_id',
        'sales_id',
        'payment_date',
        'payment_type',
        'payment',
        'payment_note',
        'change_return',
        'account_id',
        'customer_id',
        'short_code',
        'advance_adjusted',
        'cheque_number',
        'cheque_period',
        'cheque_status',
        'status',
        'created_by'
    ];
}