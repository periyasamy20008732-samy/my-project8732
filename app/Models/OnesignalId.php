<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OnesignalId extends Model
{
    protected $table ='onesignal_id';
    protected $fillable = ['user_id','store_id','player_id','external_id'];
}
