<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockTransfer extends Model
{
    //
    protected $table = "stock_transfer";
    protected $fillable = [
        'store_id',
        'to_store_id',
        'warehouse_from',
        'warehouse_to',
        'transfer_date',
        'note',
        'status',
        'created_by'

    ];
}