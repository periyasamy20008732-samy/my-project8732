<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    protected $fillable = [
        'store_id',
        'warehouse_id',
        'item_id',
        'sale_qty',
        'init_code',
        'count_id',
        'sales_code',
        'reference_no',
        'sales_date',
        'due_date',
        'sales_status',
        'customer_id',
        'other_charges_input',
        'other_charges_tax_id',
        'other_charges_amt',
        'discount_to_all_input',
        'discount_to_all_type',
        'tot_discount_to_all_amt',
        'subtotal',
        'round_off',
        'grand_total',
        'sales_note',
        'payment_status',
        'paid_amount',
        'company_id',
        'pos',
        'return_bit',
        'customer_previous_due',
        'customer_total_due',
        'quotation_id',
        'coupon_id',
        'coupon_amt',
        'invoice_terms',
        'status',
        'app_order',
        'order_id',
        'tax_report',
        'created_by'
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
    public function warehouseitem()
    {
        return $this->belongsTo(Warehouseitem::class);
    }
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
