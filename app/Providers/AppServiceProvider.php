<?php

namespace App\Providers;

use App\Services\Api\Tmdb\TmdbInterface;
use App\Services\Api\Tmdb\TmdbService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(TmdbInterface::class, TmdbService::class);

    }
}
