<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockAdjustmentItem extends Model
{
    //
    protected $table = "stock_adjustment_item";
    protected $fillable = [
        'store_id',
        'warehouse_id',
        'adjustment_id',
        'item_id',
        'adjustment_qty',
        'status',
        'description'
    ];
}
