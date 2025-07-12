<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockAdjustment extends Model
{
    //
    protected $table = "stock_adjustment";
    protected $fillable = [
        'store_id',
        'warehouse_id',
        'reference_no',
        'adjustment_date',
        'adjustment_note',
        'created_by',
        'status'
    ];
}