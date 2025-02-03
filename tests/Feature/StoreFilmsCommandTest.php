<?php

use App\Services\Api\Tmdb\TmdbService;
use App\Actions\Films\UpdateOrCreateFilmAction;
use App\Actions\Films\Details\UpdateOrCreateFilmDetailsAction;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('fetches and stores movies', function () {
    // Mock the Service
    $tmdbServiceMock = Mockery::mock(TmdbService::class);
    $tmdbServiceMock->shouldReceive('get')
        ->with(['url' => 'https://api.themoviedb.org/3/trending/all/day', 'page' => 1])
        ->andReturn([
            'results' => [
                ['id' => 1, 'title' => 'Movie 1'],
                ['id' => 2, 'title' => 'Movie 2'],
            ],
            'total_pages' => 1,
        ]);

    $tmdbServiceMock->shouldReceive('get')
        ->with(['url' => 'https://api.themoviedb.org/3/movie/1'])
        ->andReturn(['runtime' => 120, 'status' => 'Released', 'tagline' => 'A great movie']);

    // Mock the Actions
    $updateOrCreateFilmActionMock = Mockery::mock(UpdateOrCreateFilmAction::class);
    $updateOrCreateFilmActionMock->shouldReceive('execute')
        ->andReturnUsing(function ($movie) {
            return (object) ['id' => $movie['id'],'title'=>$movie['title']];
        });

    $updateOrCreateFilmDetailsActionMock = Mockery::mock(UpdateOrCreateFilmDetailsAction::class);
    $updateOrCreateFilmDetailsActionMock->shouldReceive('execute')
        ->andReturn(true);

    // Bind the mocks to the container
    app()->instance(TmdbService::class, $tmdbServiceMock);
    app()->instance(UpdateOrCreateFilmAction::class, $updateOrCreateFilmActionMock);
    app()->instance(UpdateOrCreateFilmDetailsAction::class, $updateOrCreateFilmDetailsActionMock);

    // Run the command
    $this->artisan('fetch:movies', ['--pages' => 1])
        ->expectsOutput('Mise à jour des films dans la base de données')
        ->expectsOutput('Mise à jour des films terminée')
        ->assertExitCode(0);
});

