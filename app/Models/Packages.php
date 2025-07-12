<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Packages extends Model
{
    protected $table='packages';

    protected $fillable = [ 
    'package_name',
    'validity_date',
    'if_webpanel',
    'if_android',
    'if_ios',
    'if_windows',
    'price',
    'image',
    'if_customerapp',
    'if_deliveryapp',
    'if_exicutiveapp',
    'if_multistore',
    'if_numberof_store',
    'status'
];
}