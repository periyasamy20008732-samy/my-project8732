<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PosholdItems extends Model
{
    //
    protected $table = "pos_holditems";
    protected $fillable = [
        'store_id',
        'hold_id',
        'item_id',
        'description',
        'sales_qty',
        'price_per_unit',
        'tax_type',
        'tax_id',
        'tax_amt',
        'discount_type',
        'discount_input',
        'discount_amt',
        'unit_total_cost',
        'total_cost',
        'ifexpire',
        'item_purchasetable_id'
    ];
}