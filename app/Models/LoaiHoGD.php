<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoaiHoGD extends Model
{
    use HasFactory;
    protected $fillable = [
        'idLoaiHoGD',
        'LoaiHoGD'
    ];

    public function hogiadinhs()
    {
        return $this->hasMany(HoGiaDinh::class, 'idLoaiHoGD', 'idLoaiHoGD');
    }
}