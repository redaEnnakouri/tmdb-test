<?php

namespace App\Models;

use App\Enums\Film\StatusEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Film extends Model
{
    use HasFactory;


    protected $fillable = [
        'tmdb_id',
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


    /**
     * @return HasOne
     */
    public function filmDetail(): HasOne
    {
        return $this->hasOne(FilmDetail::class);
    }

    public function scopeIsActive(Builder $query): void
    {
        $query->where('status', StatusEnum::ACTIVE->value);
    }
}
