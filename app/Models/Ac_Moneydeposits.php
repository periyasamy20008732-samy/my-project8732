<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ac_Moneydeposits extends Model
{
    //
    protected $table = "ac_moneydeposits";
    protected $fillable = ['store_id', 'deposit_date', 'reference_no', 'debit_account_id', 'credit_account_id', 'amount', 'note', 'status', 'created_by'];
}