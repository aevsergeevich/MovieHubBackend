<?php

namespace App\Console\Commands;

use App\Repositories\Genre\GenreRepository;
use App\Services\Movie\MovieService;
use Illuminate\Console\Command;
use Symfony\Component\Console\Command\Command as CommandAlias;

class ImportMovies extends Command
{
    private const int LIMIT = 20;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-movies';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Получение списка фильмов.';

    /**
     * Execute the console command.
     */
    public function handle(MovieService $movieService, GenreRepository $genreRepository): int
    {
        try {
            $count = 0;

            $start = microtime(true);

            $genres = $genreRepository->getAll();

            foreach ($genres as $genre)
            {
                $movies = $movieService->syncMovies(genre: $genre, limit: self::LIMIT);

                $count += $movies;

                $this->info('Жанр: ' . $genre->name . '. Импортировно фильмов: ' . $movies);
            }

            $end = microtime(true);

            $this->info('Синхронизация успешна. Получено: ' . $count . ' фильмов. Затрачено времени: ' . round($end - $start) . ' секунд(ы)');

            return CommandAlias::SUCCESS;

        } catch (\Exception $exception)
        {
            $this->error('Ошибка синхронизации жанров. Исключение: ' . $exception->getMessage());

            return  CommandAlias::FAILURE;
        }
    }
}
