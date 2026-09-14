<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudyLog extends Model
{
    protected $fillable = [
        'cafe_id',
        'study_minutes',
        'satisfaction',
        'visited_at',
        'memo',
    ];

    protected $casts = [
        'visited_at' => 'date',
    ];

    public function cafe()
    {
        return $this->belongsTo(Cafe::class);
    }
}
