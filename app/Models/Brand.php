<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
  protected $table = 'brands';
  protected $fillable = [
    'store_id',
    'slug',
    'count_id',
    'brand_code',
    'brand_name',
    'brand_image',
    'description',
    'status',
    'inapp_view'
  ];
}