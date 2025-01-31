<?php

namespace App\Actions\Films;

use App\Models\Film;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class UpdateOrCreateFilmAction
{


    /**
     * @param array $attributes
     * @return Model|null
     */
    public static function execute(array $attributes): Model|null
    {
        return Film::query()->updateOrCreate(
            ['tmdb_id' => $attributes['id']],
            [
                'title' => $attributes['title'] ?? 'Unknown',
                'original_title' => $attributes['original_title'] ?? 'Unknown',
                'overview' => $attributes['overview'] ?? null,
                'media_type' => $attributes['media_type'] ?? null,
                'original_language' => $attributes['original_language'] ?? null ,
                'adult' => $attributes['adult'] ,
                'backdrop_path' =>isset($attributes['backdrop_path']) ? "https://image.tmdb.org/t/p/w500{$attributes['backdrop_path']}" : null,
                'release_date' => $attributes['release_date'] ?? null,
                'poster_path' => isset($attributes['poster_path']) ?"https://image.tmdb.org/t/p/w500{$attributes['poster_path']}" : null,
                'vote_average' => $attributes['vote_average'] ?? 0,
                'vote_count' => $attributes['vote_count']?? 0]
        );
    }
}
