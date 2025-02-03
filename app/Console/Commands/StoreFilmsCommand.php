<?php

namespace App\Console\Commands;

use App\Actions\Films\Details\UpdateOrCreateFilmDetailsAction;
use App\Actions\Films\UpdateOrCreateFilmAction;
use App\Services\Api\Tmdb\TmdbService;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class StoreFilmsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:movies {--pages= : number de pages à traiter}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mise à jour des films dans la base de données';

    /**
     * Execute the console command.
     * @throws Exception
     */
    public function handle()
    {

        DB::beginTransaction();
        try {
            $this->info('Mise à jour des films dans la base de données');
            $page = 1; // Start with the first page
            $totalPages = 500;
            $maxPages = $this->option('pages') ? (int)$this->option('pages') : $totalPages; // Use --pages option if provided
            $progress = $this->output->createProgressBar($maxPages);
            $progress->start();

            while (true) {
                $api = new (TmdbService::class);
                $data = $api->get([
                    'url' => 'https://api.themoviedb.org/3/trending/all/day',
                    'page' => $page
                ]);

                $movies = $data['results'] ?? [];
                $totalPages = $data['total_pages'] ?? 1;

                // Store movies and details in the database
                collect($movies)->each(function ($movie) use ($api) {
                    $film = UpdateOrCreateFilmAction::execute($movie);

                    // Store each movie details in the database
                    $details = $api->get([
                        'url' => 'https://api.themoviedb.org/3/movie/' . $movie['id'],
                    ]);

                    if(isset($details))
                        UpdateOrCreateFilmDetailsAction::execute($film, Arr::only($details, ['runtime', 'status', 'tagline']));

                });

                if ($page >= $totalPages || $page >= $maxPages) {
                    break;
                }
                $progress->advance();
                $page++;
            }
            $progress->finish();
            $this->line('');
            $this->info('Mise à jour des films terminée');

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            throw $e;
        }
    }


}
