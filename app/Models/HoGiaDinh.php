<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HoGiaDinh extends Model
{
    use HasFactory;
    protected $table = 'HoGiaDinh';
    protected $primaryKey = 'idHoGiaDinh';
    protected $fillable = [
        'idHoGiaDinh',
        'idLoaiHoGD',
        'soLuongThanhVien',
        'diaChi'
    ];

    public function loaiHoGD()
    {
        return $this->hasOne(Menu::class, 'id', 'menu_id')
            ->withDefault(['LoaiHoGD' => '']);
    }
}
