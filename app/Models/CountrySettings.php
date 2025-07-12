<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CountrySettings extends Model
{
    protected $table ='country_settings';
    protected $fillable = [  'name',
            'mobile_code',
            'currency_code',
            'currency_symble',
            'status'];
}
