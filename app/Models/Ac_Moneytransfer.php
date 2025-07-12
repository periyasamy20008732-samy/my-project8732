<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ac_Moneytransfer extends Model
{
    //
    protected $table = "ac_moneytransfer";
    protected $fillable = [
        'store_id',
        'count_id',
        'transfer_code',
        'transfer_date',
        'reference_no',
        'debit_account_id',
        'credit_account_id',
        'amount',
        'note',
        'status',
        'created_by'
    ];
}