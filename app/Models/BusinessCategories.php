<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessCategories extends Model
{
    //
    protected $table = 'business_category';
    protected $fillable = [
        'name',
        'status'

    ];
}