<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FavoriteCafe extends Model
{
        protected $fillable = [
        'user_id',
        'cafe_id',
    ];
    protected $table = 'favorite_cafe';
}
