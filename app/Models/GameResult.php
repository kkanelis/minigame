<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameResult extends Model
{
    protected $fillable = [
        'nickname',
        'difficulty',
        'time_taken',
        'words_per_minute',
        'accuracy'
    ];

    protected $casts = [
        'time_taken' => 'integer',
        'words_per_minute' => 'integer',
        'accuracy' => 'integer'
    ];
}
