<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceSettings extends Model
{
    //
    protected $table = 'invoice_settings';
    protected $fillable = [
        'store_id',
        'user_id',
        'business_name',
        'address',
        'email',
        'phone',
        'gst_number',
        'prefix',
        'start_number',
        'invoice_numbering',
        'invoice_notes',
        'include_notes',
        'taxrate',
        'payment_details',
        'copy_customer',
        'bussiness_logo',
        'template',
    ];
}
