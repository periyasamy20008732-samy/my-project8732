<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseItem extends Model

    //class Purchase extends Model
{

    protected $table = 'purchaseitems';
    protected $fillable = [
        'store_id',
        'purchase_id',
        'purchase_status',
        'item_id',
        'purchase_qty',
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
        'if_batch',
        'batch_no',
        'if_expirydate',
        'expire_date',
        'description',
        'status'
    ];

    public function scopeBetweenDates($query, $from, $to)
    {
        return $query->whereBetween('created_at', [$from, $to]);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

}