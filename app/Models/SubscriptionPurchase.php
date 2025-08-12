<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionPurchase extends Model
{
    //
    use HasFactory;

    protected $table = 'subcription_purchase'; // only needed if the table is not 'payments'

    protected $fillable = [
        'user_id',
        'package_id',
        'validity_date',
        'payment_id',
        'payment_status',
        'if_webpanel',
        'if_android',
        'if_windows',
        'price',
        'image',
        'if_customerapp',
        'if_deliveryapp',
        'if_exicutiveapp',
        'if_multistore',
        'if_numberof_store',
    ];


    public function package()
    {
        return $this->belongsTo(Packages::class, 'package_id', 'id');
    }
    // public function payment()
    // {
    //     return $this->belongsTo(OnlinePayment::class, 'payment_id', 'id');
    // }
    public function payment()
    {
        return $this->belongsTo(\App\Models\OnlinePayment::class, 'payment_id', 'id');
    }
}
