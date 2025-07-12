<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesReturn extends Model
{
    protected $table = 'sales_return';
    protected $fillable = [
        'store_id',
        'count_id',
        'sales_id',
        'warehouse_id',
        'return_code',
        'reference_no',
        'return_date',
        'return_status',
        'customer_id',
        'other_charges_input',
        'other_charges_tax_id',
        'other_charges_amt',
        'discount_to_all_input',
        'discount_to_all_type',
        'tot_discount_to_all_amt',
        'subtotal',
        'round_off',
        'grand_total',
        'return_note',
        'payment_status',
        'paid_amount',
        'pos',
        'status',
        'return_bit',
        'coupon_id',
        'coupon_amt',
        'app_order',
        'order_id',
        'created_by'



    ];
}