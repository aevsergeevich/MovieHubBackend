<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class MovieClientService
{
    private const string GENRES_ENDPOINT = '/3/genre/movie/list';
    private const string MOVIES_ENDPOINT = '/3/discover/movie';

    public function fetchMovies(int $genreId, int $page): array
    {
        return $this->fetch(endpoint: self::MOVIES_ENDPOINT, params:
            [
                'api_key' => config('tmdb.api_key'),
                'with_genres' => $genreId,
                'language' => 'ru',
                'page' => $page
            ]
        );
    }

    public function fetchGenres(): array
    {
        $response = $this->fetch(endpoint: self::GENRES_ENDPOINT, params:
            [
                'api_key' => config('tmdb.api_key'),
                'language' => 'ru'
            ]
        );

        return $response['genres'];
    }

    private function fetch(string $endpoint, array $params = []): array
    {
        $response = Http::get(config('tmdb.api_url') . $endpoint, $params);

        if (!$response->successful())
        {
            return [];
        }

        return $response->json();
    }
}
