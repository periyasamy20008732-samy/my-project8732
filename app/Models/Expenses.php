<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    //
    protected $table = "expenses";

    protected $fillable = [
        'store_id',
        'count_id',
        'expense_code',
        'category_id',
        'expense_date',
        'reference_no',
        'expense_for',
        'expense_amt',
        'payment_type',
        'account_id',
        'note',
        'created_by',
        'status'
    ];
}
