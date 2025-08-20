<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
  protected $table = 'purchase';
  protected $fillable = [
    'store_id',
    'warehouse_id',
    'count_id',
    'purchase_code',
    'reference_no',
    'purchase_date',
    'supplier_id',
    'other_charges_input',
    'other_charges_tax_id',
    'other_charges_amt',
    'discount_to_all_input',
    'discount_to_all_type',
    'tot_discount_to_all_amt',
    'subtotal',
    'round_off',
    'grand_total',
    'purchase_note',
    'payment_status',
    'paid_amount',
    'company_id',
    'status',
    'return_bit',
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
  public function items()
  {
    return $this->hasMany(PurchaseItem::class, 'purchase_id', 'id');
  }

  public function supplier()
  {
    return $this->belongsTo(Supplier::class);
  }

  public function purchaseItems()
  {
    return $this->hasMany(PurchaseItem::class, 'purchase_id', 'id');
  }

  public function payments()
  {
    return $this->hasMany(PurchasePayment::class, 'purchase_id', 'id');
  }
  public function warehouse()
  {
    return $this->belongsTo(Warehouse::class, 'warehouse_id');
  }
}
