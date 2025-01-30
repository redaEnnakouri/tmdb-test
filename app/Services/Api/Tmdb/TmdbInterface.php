<?php

namespace App\Services\Api\Tmdb;


interface TmdbInterface
{

    /**
     * @param array $attributes
     */
    public function get(array $attributes);
}
