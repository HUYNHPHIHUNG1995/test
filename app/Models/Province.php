<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];

    protected $table='provinces';
    protected $primaryKey='code';//khai bao khoa chinh
    public $incrementing=false;

    //1 tinh co nhieu quan,quan he bang province_code
    public function districts()
    {
        return $this->hasMany(District::class,'province_code','code');
    }
}
