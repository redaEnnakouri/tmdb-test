<?php


use App\Models\Film;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia;

uses(RefreshDatabase::class);

it('fetch a movies', function () {
    // Create and authenticate a user
    $user = User::factory()->create();
    $this->actingAs($user);

    Film::factory()->count(3)->create();
    $response = $this->get(route('api.films.index'));


    $response->assertStatus(200);
    $response->assertJsonCount(3, 'data');
});


it('fetch a movie', function () {
    // Create and authenticate a user
    $user = User::factory()->create();
    $this->actingAs($user);

    $film = Film::factory()->create();
    $response = $this->get(route('films.show', $film->id));


    $response->assertStatus(200);

    $response->assertStatus(200);
    $response->assertInertia(function (AssertableInertia $page) use ($film) {
        $page->has('film', function (AssertableInertia $filmPage) use ($film) {
            $filmPage->where('id', $film->id)
                ->where('tmdb_id', $film->tmdb_id)
                ->where('title', $film->title)
                ->where('original_title', $film->original_title)
                ->where('overview', $film->overview)
                ->where('poster_path', $film->poster_path)
                ->where('media_type', $film->media_type)
                ->where('backdrop_path', $film->backdrop_path)
                ->where('release_date', $film->release_date)
                ->where('original_language', $film->original_language)
                ->where('adult', $film->adult)
                ->where('vote_average', $film->vote_average)
                ->where('vote_count', $film->vote_count)
                ->where('status', (string) $film->status)
                ->where('created_at', $film->created_at->toISOString())
                ->where('updated_at', $film->updated_at->toISOString())
                ->has('film_detail');
        });
    });
});
