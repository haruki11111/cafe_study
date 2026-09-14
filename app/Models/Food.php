<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $fillable = [
        'name',
        'genre',
        'price',
        'spicy',
    ];

    protected $table = 'foods'; 
}
