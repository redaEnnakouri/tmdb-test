<?php


use App\Models\Film;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('deletes a movie', function () {
    // Create and authenticate a user
    $user = User::factory()->create();
    $this->actingAs($user);

    $film = Film::factory()->create();
    $response = $this->delete(route('films.destroy', $film->id));


    $response->assertStatus(302);
    $this->assertDatabaseMissing('films', ['id' => $film->id]);

});


