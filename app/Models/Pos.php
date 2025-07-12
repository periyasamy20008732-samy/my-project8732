<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pos extends Model
{
    //
    protected $table = "pos_hold";
    protected $fillable = [
        'store_id',
        'warehouse_id',
        'reference_id',
        'reference_no',
        'sales_date',
        'sales_status',
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
        'sales_note',
        'pos',
        'created_by'
    ];

}