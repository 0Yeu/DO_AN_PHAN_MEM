<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DotLuLut extends Model
{
    use HasFactory;
    protected $table = 'DotLuLut';
    protected $primaryKey = 'idDotLuLut';
    protected $fillable = [
        'idDotLuLut',
        'tenDotLuLut',
        'thoiGian',
    ];
}
