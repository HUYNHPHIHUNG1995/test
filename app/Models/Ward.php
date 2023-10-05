<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];

    protected $table='wards';
    protected $primaryKey='code';//khai bao khoa chinh
    public $incrementing=false;

    public function district()
    {
        return $this->belongsTo(District::class,'district_code',code);
    }
}
