<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_level extends Model
{
    //
    protected $table = 'user_level';
    protected $fillable = [

        'name',
        'role'
    ];

    public function users()
{
    return $this->hasMany(User::class);
}

}