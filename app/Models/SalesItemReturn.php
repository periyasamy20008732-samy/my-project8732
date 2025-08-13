<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesItemReturn extends Model
{
    protected $table = "sales_item_return";
    protected $fillable = [

        'store_id',
        'sales_id',
        'return_id',
        'customer_id',
        'sales_status',
        'item_id',
        'item_name',
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
        'status',
        'seller_points',
        'purchase_price'
    ];


    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
