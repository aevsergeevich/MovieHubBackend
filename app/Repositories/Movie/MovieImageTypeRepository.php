<?php

namespace App\Repositories\Movie;

use App\Models\Movie\MovieImageType;

class MovieImageTypeRepository
{
    public function __construct(private MovieImageType $movieImageType){}

    public function findIdByType(string $type): int
    {
        return $this->movieImageType->query()->where('type', $type)->value('id');
    }
}