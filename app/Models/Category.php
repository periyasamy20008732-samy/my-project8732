<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  protected $table = 'categories';
  protected $fillable = [
    'store_id',
    'parent_id',
    'slug',
    'count_id',
    'category_code',
    'category_name',
    'image',
    'description',
    'status',
    'inapp_view'
  ];
  public function items()
  {
    return $this->hasMany(Item::class);
  }
}
