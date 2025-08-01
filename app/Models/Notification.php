<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    //
    protected $table='notification';

    protected $fillable =[
           'userid',
            'created_by',
            'title',
            'msg',
            'link',
            'data',
            'status'
    ];
}