<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class MovieClientService
{
    private const string GENRES_ENDPOINT = '/3/genre/movie/list';

    public function getMovieGenres(): array
    {
        $genres = $this->fetch(endpoint: self::GENRES_ENDPOINT, params: ['api_key' => config('tmdb.api_key')]);

        return $genres['genres'];
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
