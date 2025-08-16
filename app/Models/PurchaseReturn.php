<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseReturn extends Model
{
    protected $table = 'purchase_return';

    protected $fillable = [
        'store_id',
        'warehouse_id',
        'purchase_id',
        'count_id',
        'return_code',
        'reference_no',
        'return_date',
        'return_status',
        'supplier_id',
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
        'status',
        'created_by'
    ];
}
