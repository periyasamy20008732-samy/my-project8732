<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseItemReturn extends Model
{
    protected $tabl = "purchase_item_return";
    protected $fillable = [
        'store_id',
        'purchase_id',
        'return_id',
        'return_status',
        'item_id',
        'return_qty',
        'price_per_unit',
        'tax_type',
        'tax_id',
        'tax_amt',
        'discount_type',
        'discount_input',
        'discount_amt',
        'unit_total_cost',
        'total_cost',
        'profit_margin_per',
        'unit_sales_price',
        'stock',
        'if_bach',
        'bach_no',
        'if_expirydate',
        'expire_date',
        'description',
        'status'
    ];
}