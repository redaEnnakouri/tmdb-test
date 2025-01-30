<?php

namespace App\Actions\Films;

use App\Models\Film;

class UpdateFilmAction
{


    /**
     * @param Film $film
     * @param array $attributes
     * @return bool
     */
    public static function execute(Film $film,array $attributes): bool
    {
        return $film->update($attributes);
    }
}
