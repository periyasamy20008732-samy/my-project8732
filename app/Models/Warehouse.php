<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    protected $table = 'warehouse';
    protected $fillable = ['user_id', 'store_id', 'warehouse_type', 'warehouse_name', 'address', 'mobile', 'email', 'status'];
}
