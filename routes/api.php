<?php

use App\Http\Controllers\PitchShowcaseController;
use Illuminate\Support\Facades\Route;

Route::post('/showcase/pitch', [PitchShowcaseController::class, 'storeApi'])
    ->name('api.pitch.showcase.store');
