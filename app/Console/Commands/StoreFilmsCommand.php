<?php

namespace App\Console\Commands;

use App\Actions\Films\UpdateOrCreateFilmAction;
use App\Services\Api\Tmdb\TmdbService;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class StoreFilmsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:mis-a-jour-films';

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
            $progress = $this->output->createProgressBar($totalPages);
            $progress->start();

            while (true) {
                $api = new (TmdbService::class);
                $data = $api->get([
                    'url' => 'https://api.themoviedb.org/3/trending/all/day?language=en-US',
                    'page' => $page
                ]);

                $movies = $data['results'] ?? [];
                $totalPages = $data['total_pages'] ?? 1;

                // Store movies in the database
                foreach ($movies as $movie) {
                    UpdateOrCreateFilmAction::execute($movie);
                }

                if ($page >= $totalPages) {
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
