<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderLog extends Model
{
    //
    protected $table = "order_log";
    protected $fillable = [
        'order_id',
        'description',
        'subject',
        'order_status',
        'log_by'
    ];
}