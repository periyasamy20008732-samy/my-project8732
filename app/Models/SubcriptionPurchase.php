<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubcriptionPurchase extends Model
{
    //
    protected $table = 'store';

    protected $fillable = [
        'user_id',
        'package_id',
        'validity',
        'payment_id',
        'payment_status'
    ];
}
