<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    protected $table = "tax";
    protected $fillable = ['store_id', 'tax_name', 'validity_date','tax', 'if_group', 'subtax_ids', 'status'];
}