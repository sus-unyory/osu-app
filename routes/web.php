<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OsuController;



Route::get('/osu', [OsuController::class, 'index']);
Route::post('/osu', [OsuController::class, 'check']);
Route::get('/profile', [App\Http\Controllers\OsuController::class, 'show']);


Route::get('/', function () {
    return view('welcome');
});
