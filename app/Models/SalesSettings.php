<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesSettings extends Model
{
    //

    protected $table = 'sales_settings';
    protected $fillable = [
        'store_id',
        'user_id',
        'account',
        'discount',
        'show_mrp',
        'show_paidamount',
        'show_return',
        'footer_text',
        'sale_invoice',
        'pos_invoice',
        'number_to_word',
        'show_previous_balance',
        'show_invoice',
        'show_pos_invoice',
        'term_conditions',
    ];
}
