<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccountSettings extends Model
{
    //
    protected $table = "accountsettings";
    protected $fillable = [
        'account_name',
        'bank_name',
        'account_number',
        'ifsc_code',
        'upi_id',
        'balance',
        'user_id',
        'store_id'
    ];
}