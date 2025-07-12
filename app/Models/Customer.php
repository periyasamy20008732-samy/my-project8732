<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';
    protected $fillable = [
        
        'store_id',
        'user_id',
        'count_id',
        'customer_code',
        'customer_name',
        'mobile',
        'phone',
        'email',
        'gstin',
        'tax_number',
        'vatin',
        'opening_balance',
        'sales_due',
        'sales_return_due',
        'country_id',
        'state',
        'city',
        'postcode',
        'address',
        'location_link',
        'attachment_1',
        'price_level_type',
        'price_level',
        'delete_bit',
        'tot_advance',
        'credit_limit',
        'status',
        'created_by'
    ];

    public function country()
    {
        return $this->belongsTo(CountrySettings::class);
    }

}