<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubUnit extends Model
{
    protected $table = 'sub_units';
    protected $fillable = ['unit_id','sub_unit_name','sub_unit_value','sub_description','status'];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
