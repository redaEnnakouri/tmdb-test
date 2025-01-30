<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'title',
        'original_title',
        'overview',
        'poster_path',
        'media_type',
        'backdrop_path',
        'release_date',
        'original_language',
        'adult',
        'vote_average',
        'vote_count',
    ];

    protected $casts = [
        'adult' => 'boolean',
    ];
}
