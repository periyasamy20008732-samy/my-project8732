<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WarehouseItem extends Model
{
    protected $table = 'warehouseitems';
    protected $fillable = ['store_id', 'warehouse_id', 'item_id', 'available_qty', 'batch_no', 'expiry_date'];
}