<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table='supplier';
    protected $fillable =[  'store_id','cound_id',
           'supplier_code',
            'supplier_name',
            'mobile',
            'phone',
            'email',
           'gstin',
           'tax_number',
            'vatin',
            'opening_balance',
            'purchase_due',
            'purchase_return_due',
           'country_id',
            'state_id',
            'state',
            'city',
            'postcode',
            'address',
           'company_id',
        'status'];
}
