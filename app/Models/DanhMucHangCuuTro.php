<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanhMucHangCuuTro extends Model
{
    use HasFactory;
    protected $table = 'DanhMucHangCuuTro';
    protected $primaryKey = 'idDanhMuc';
    protected $fillable = [
        'idDanhMuc',
        'tenDanhMuc',
        'moTa',
    ];
}
