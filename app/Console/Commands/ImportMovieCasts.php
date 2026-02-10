<?php

namespace App\Console\Commands;

use App\Repositories\Movie\MovieRepository;
use App\Services\Movie\MovieCastService;
use Illuminate\Console\Command;
use Symfony\Component\Console\Command\Command as CommandAlias;

class ImportMovieCasts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-movie-casts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Получение списка актеров.';

    /**
     * Execute the console command.
     */
    public function handle(MovieCastService $movieCastService, MovieRepository $movieRepository): int
    {
        try {
            $count = 0;

            $start = microtime(true);

            $movies = $movieRepository->getAll();

            foreach ($movies as $movie)
            {
                $casts = $movieCastService->syncMovieCasts(movie: $movie);

                $count += $casts;

                $this->info('Фильм: ' . $movie->title . '. Импортировно актеров: ' . $casts);
            }

            $end = microtime(true);

            $this->info('Синхронизация успешна. Получено: ' . $count . ' актеров. Затрачено времени: ' . round($end - $start) . ' секунд(ы)');

            return CommandAlias::SUCCESS;

        } catch (\Exception $exception)
        {
            $this->error('Ошибка синхронизации актеров. Исключение: ' . $exception->getMessage());

            return  CommandAlias::FAILURE;
        }
    }
}
