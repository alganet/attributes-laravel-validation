<?php

use App\Http\Controllers\PitchShowcaseController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/showcase/pitch');

Route::get('/showcase/pitch', [PitchShowcaseController::class, 'show'])->name('pitch.showcase');
Route::post('/showcase/pitch', [PitchShowcaseController::class, 'store'])->name('pitch.showcase.store');
