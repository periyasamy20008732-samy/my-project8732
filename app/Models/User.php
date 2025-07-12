<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
//use Illuminate\Sanctum\HasApiTokens;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;
    // use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $table = 'users'; // VERY IMPORTANT if table name is 'users'

    protected $fillable = [

        'user_level',
        'store_id',
        'name',
        'email',
        'country_code',
        'mobile',
        'password',
        'whatsapp_no',
        'user_card',
        'profile_image',
        'dob',
        'count_id',
        'employee_code',
        'warehouse_id',
        'current_latitude',
        'current_longitude',
        'zone',
        'otp',
        'expires_at',
        'code',
        'status',
        'mobile_verify',
        'email_verify',
        'ban',
        'created_by',
        'subscription_id',
        'subscription_start',
        'subscription_end',
        'license_key'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            //'password' => 'hashed',
        ];
    }


    public $timestamps = true;

    public function isExpired()
    {
        return Carbon::now()->greaterThan($this->expires_at);
    }
    public function userLevel()
{
    return $this->belongsTo(User_level::class);
}


}