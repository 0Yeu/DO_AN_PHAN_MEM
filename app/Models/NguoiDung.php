<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\Authenticatable;

class NguoiDung extends User implements Authenticatable
{
    use HasFactory;
    protected $table = 'NguoiDung';
    protected $primaryKey = 'idNguoiDung';
    protected $fillable = [
        'hoTen',
        'idquyen',
        'taiKhoan',
        'matKhau',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'matKhau',
        'remember_token',
    ];
    public function getAuthPassword() {
        return $this->matKhau;
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function getTenNguoiDung(){
        return $this->hoTen;
    }
    public function getAuthIdentifierName()
    {
        return 'idNguoiDung';
    }

    public function getAuthIdentifier()
    {
        return $this->idNguoiDung;
    }

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }
    public function getIdQuyen()
    {
        return $this->idQuyen;
    }

}
