<?php

namespace Database\Factories;


use App\Enums\Film\StatusEnum;
use Illuminate\Database\Eloquent\Factories\Factory;


class FilmFactory extends Factory
{


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tmdb_id' => fake()->numberBetween(1, 1000),
            'title' => fake()->sentence(3),
            'original_title' => fake()->sentence(3),
            'overview' => fake()->sentence(3),
            'poster_path' => fake()->imageUrl(),
            'media_type' => 'movie',
            'backdrop_path' => fake()->imageUrl(),
            'release_date' => fake()->date(),
            'original_language' => fake()->languageCode(3),
            'adult' => fake()->boolean(),
            'vote_average' => fake()->numberBetween(1, 10),
            'vote_count' => fake()->randomNumber(),
            'status' => StatusEnum::ACTIVE->value,
        ];
    }
}
