<?php

namespace App\Console\Commands;

use App\Repositories\Movie\MovieRepository;
use App\Services\Movie\MovieImageService;
use Illuminate\Console\Command;
use Symfony\Component\Console\Command\Command as CommandAlias;

class ImportMovieImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-movie-images';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Получение картинок всех видов.';

    /**
     * Execute the console command.
     */
    public function handle(MovieImageService $movieImageService, MovieRepository $movieRepository): int
    {
        try {
            $count = 0;

            $start = microtime(true);

            $movies = $movieRepository->getAll();

            foreach ($movies as $movie)
            {
                $images = $movieImageService->syncMovieImages(movie: $movie);

                $count += $images;

                $this->info('Фильм: ' . $movie->title . '. Импортировно катинок: ' . $images);
            }

            $end = microtime(true);

            $this->info('Синхронизация успешна. Получено: ' . $count . ' картинок. Затрачено времени: ' . round($end - $start) . ' секунд(ы)');

            return CommandAlias::SUCCESS;

        } catch (\Exception $exception)
        {
            $this->error('Ошибка синхронизации актеров. Исключение: ' . $exception->getMessage());

            return CommandAlias::FAILURE;
        }
    }
}
