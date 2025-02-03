<?php


use App\Models\Film;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('updates a movie', function () {
    // Create and authenticate a user
    $user = User::factory()->create();
    $this->actingAs($user);


    $film = Film::factory()->create();
    $response = $this->put(route('films.update', $film->id), [
        'title' => 'Movie 1',
    ]);


    $response->assertStatus(302);
    $this->assertDatabaseHas('films', [
        'id' => $film->id,
        'title' => 'Movie 1',
    ]);
});


it('fails to update a movie', function () {
    // Create and authenticate a user
    $user = User::factory()->create();
    $this->actingAs($user);

    $film = Film::factory()->create();
    $response = $this->put(route('films.update', $film->id), [
        'title' => '',
    ]);

    $response->assertSessionHasErrors('title');
    $this->assertDatabaseHas('films', [
        'id' => $film->id,
        'title' => $film->title,
    ]);
});
