<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];

    protected $table='districts';
    protected $primaryKey='code';//khai bao khoa chinh
    public $incrementing=false;
    //1 province_code thuoc ve 1 tinh
    public function province()
    {
        return $this->belongsTo(Province::class,'province_code','code');
    }

    public function wards()
    {
        return $this->hasMany(Ward::class,'district_code','code');
    }
}
