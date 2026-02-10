<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Test\TestController;

Route::prefix('v1')->group(function () {

    Route::get('test-genres', [
        TestController::class, 'testGenres'
    ])->name('test-genres');

    Route::get('test-movies/{genre}', [
        TestController::class, 'testMovies'
    ])->name('test-movies');

    Route::get('test-movie-casts/{movie}', [
        TestController::class, 'testMovieCasts'
    ])->name('test-movie-casts');

    Route::get('test-movie-crews/{movie}', [
        TestController::class, 'testMovieCrews'
    ])->name('test-movie-crews');

    Route::get('test-movie-images/{movie}', [
        TestController::class, 'testMovieImages'
    ])->name('test-movie-images');

});


