<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
  protected $table = 'items';
  protected $fillable = [
    'store_id',
    'user_id',
    'user_name',
    'item_image',
    'item_name',
    'category_id',
    'brand_id',
    'SKU',
    'HSN_code',
    'Item_code',
    'Barcode',
    'Unit',
    'Description',
    'Purchase_price',
    'Tax_type',
    'Tax_rate',
    'Sales_Price',
    'MRP',
    'Discount_type',
    'Discount',
    'Profit_margin',
    'Warehouse',
    'Opening_Stock',
    'Alert_Quantity',
    'quantity',
    'batch_no',
    'expiry_date'
  ];


  protected $casts = [
    'item_image' => 'array',
  ];
}
