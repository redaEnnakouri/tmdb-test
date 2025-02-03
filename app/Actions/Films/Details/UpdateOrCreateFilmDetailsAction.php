<?php

namespace App\Actions\Films\Details;

use App\Models\Film;
use App\Models\FilmDetail;
use Illuminate\Database\Eloquent\Model;

class UpdateOrCreateFilmDetailsAction
{


    /**
     * @param Film $film
     * @param array $attributes
     * @return Model|null
     */
    public static function execute(Film $film,array $attributes): Model|null
    {
        return FilmDetail::query()->updateOrCreate(
            ['film_id' => $film->id],
            [
                'runtime' => $attributes['runtime'] ?? null,
                'status' => $attributes['status']?? null,
                'tagline' => $attributes['tagline']?? null,
            ]);
    }
}
