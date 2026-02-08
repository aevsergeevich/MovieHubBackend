<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Test\TestController;

Route::prefix('v1')->group(function () {

    Route::get('test-genres',
        [TestController::class, 'testGenres'])->name('test-genres');

});


