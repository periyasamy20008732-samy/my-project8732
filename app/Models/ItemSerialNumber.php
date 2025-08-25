<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemSerialNumber extends Model
{
    //
    protected $table = 'itemserial_number';
    protected $fillable = [
        'store_id',
        'item_id',
        'serialno',
        'purchase_id',
        'purchase_return_id',
        'sales_id',
        'sales_return_id',
        'created_by',
        'status'
    ];
}
