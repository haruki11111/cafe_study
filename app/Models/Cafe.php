<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Cafe extends Model
{
    protected $fillable = [
        'name',
        'station',
        'average_price',
        'wifi',
        'power_supply',
        'quiet_level',
        'rating',
        'memo',
    ];

    public function studyLogs()
    {
        return $this->hasMany(StudyLog::class);
    }

    public function favoritedByUsers(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'favorite_cafe'
        )->withTimestamps();
    }
}
