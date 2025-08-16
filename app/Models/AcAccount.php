<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcAccount extends Model
{
    protected $table = 'ac_accounts';
    protected $fillable = [
        'count_id',
        'store_id',
        'parent_id',
        'sort_code',
        'account_code',
        'balance',
        'note',
        'status',
        'delete_bit',
        'account_selection_name',
        'paymenttypes_id',
        'customer_id',
        'supplier_id',
        'expense_id',
        'created_by'
    ];
}
