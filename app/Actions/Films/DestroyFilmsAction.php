<?php
namespace App\Actions\Films;

use App\Models\Film;

class DestroyFilmsAction
{

    /**
     * @param Film $film
     * @return bool
     */
    public static function execute(Film $film): bool
    {
        return $film->delete();
    }
}
