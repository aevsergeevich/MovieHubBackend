<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1;

Route::prefix('v1')->group(function () {

    Route::get('genres', [
        V1\Genre\GenreController::class, 'index'
    ])->name('genres.index');

    Route::get('test-genres', [
        V1\Test\TestController::class, 'testGenres'
    ])->name('test-genres');

    Route::get('test-movies/{genre}', [
        V1\Test\TestController::class, 'testMovies'
    ])->name('test-movies');

    Route::get('test-movie-casts/{movie}', [
        V1\Test\TestController::class, 'testMovieCasts'
    ])->name('test-movie-casts');

    Route::get('test-movie-crews/{movie}', [
        V1\Test\TestController::class, 'testMovieCrews'
    ])->name('test-movie-crews');

    Route::get('test-movie-images/{movie}', [
        V1\Test\TestController::class, 'testMovieImages'
    ])->name('test-movie-images');

});


