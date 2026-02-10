<?php

namespace App\Console\Commands;

use App\Repositories\Movie\MovieRepository;
use App\Services\Movie\MovieCrewService;
use Illuminate\Console\Command;
use Symfony\Component\Console\Command\Command as CommandAlias;

class ImportMovieCrews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-movie-crews';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Получение списка членов команды.';

    /**
     * Execute the console command.
     */
    public function handle(MovieCrewService $movieCrewService, MovieRepository $movieRepository): int
    {
        try {
            $count = 0;

            $start = microtime(true);

            $movies = $movieRepository->getAll();

            foreach ($movies as $movie)
            {
                $crews = $movieCrewService->syncMovieCrews(movie: $movie);

                $count += $crews;

                $this->info('Фильм: ' . $movie->title . '. Импортировно членов команды: ' . $crews);
            }

            $end = microtime(true);

            $this->info('Синхронизация успешна. Получено: ' . $count . ' чиленов команды. Затрачено времени: ' . round($end - $start) . ' секунд(ы)');

            return CommandAlias::SUCCESS;

        } catch (\Exception $exception)
        {
            $this->error('Ошибка синхронизации актеров. Исключение: ' . $exception->getMessage());

            return CommandAlias::FAILURE;
        }
    }
}
