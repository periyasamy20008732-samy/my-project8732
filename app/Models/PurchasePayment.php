<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchasePayment extends Model
{
  protected $table = 'purchase_payments';
  protected $fillable = [
    'count_id',
    'payment_code',
    'store_id',
    'purchase_id',
    'payment_date',
    'payment_type',
    'payment',
    'payment_note',
    'status',
    'account_id',
    'supplier_id',
    'short_code',
    'created_by',
  ];
  public function purchase()
  {
    return $this->belongsTo(Purchase::class, 'purchase_id', 'id');
  }
   public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }
}
