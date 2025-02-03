<?php

namespace App\Actions\Films;

use App\Models\Film;

class GetFilmsAction
{


    /**
     * @param Film $film
     * @param array $attributes
     * @return Film
     */
    public static function execute(Film $film,array $attributes = []): Film
    {
        return $film->load('filmDetail');
    }
}
