<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockTransferItem extends Model
{
    //
    protected $table = "stock_transfer_item";
    protected $fillable = [
        'stocktransfer_id',
        'store_id',
        'to_store_id',
        'warehouse_from',
        'warehouse_to',
        'item_id',
        'transfer_qty',
        'status'
    ];
}