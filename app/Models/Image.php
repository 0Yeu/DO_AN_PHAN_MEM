<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'path'];

    public function getPathAttribute()
    {
        if (isset($this->attributes['path'])) {
            return asset("storage/{$this->attributes['path']}");
        }
        return null;
    }
}
