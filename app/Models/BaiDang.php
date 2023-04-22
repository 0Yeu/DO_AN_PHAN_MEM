<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaiDang extends Model
{
    use HasFactory;
    protected $table = 'BaiDang';
    protected $primaryKey = 'idBaiDang';
    protected $fillable = [
        'idBaiDang',
        'tenDotCuuTro',
        'idDotLuLut',
        'ngayBatDau',
        'ngayKetThuc',
        'hinhAnh',
        'soTien',
        'noiDung'
    ];
}
