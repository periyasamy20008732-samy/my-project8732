<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesItem extends Model
{
    protected $table = 'sales_item';
    protected $fillable = [
        'store_id',
        'sales_id',
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
        'dicount_type',
        'discount_input',
        'discount_amt',
        'unit_total_cost',
        'total_cost',
        'status',
        'seller_points',
        'purchase_price'
    ];
    public function scopeBetweenDates($query, $from, $to)
    {
        return $query->whereBetween('created_at', [$from, $to]);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}