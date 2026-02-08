<?php

namespace App\Console\Commands;

use App\Services\Genre\GenreService;
use Illuminate\Console\Command;
use Symfony\Component\Console\Command\Command as CommandAlias;

class ImportGenres extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-genres';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Получение списка жанров.';

    /**
     * Execute the console command.
     */
    public function handle(GenreService $genreService): int
    {
        try
        {
            $start = microtime(true);

            $genres = $genreService->syncGenres();

            $end = microtime(true);

            $this->info('Синхронизация успешна. Получено: ' . $genres . ' жанров. Затрачено времени: ' . round($end - $start) . ' секунд(ы)');

            return CommandAlias::SUCCESS;

        } catch (\Exception $exception)
        {
            $this->error('Ошибка синхронизации жанров. Исключение: ' . $exception->getMessage());

            return CommandAlias::FAILURE;
        }
    }
}
