<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Units extends Model
{
    protected $table = 'units';
    protected $fillable = ['store_id','parent_id','name','unit_name','unit_value','description','status'];


}