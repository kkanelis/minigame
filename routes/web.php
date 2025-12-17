<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;

// Welcome page
Route::get('/', function () {
    return view('welcome');
});

// Game routes
Route::get('/game', [GameController::class, 'index'])->name('game');
Route::get('/leaderboard', [GameController::class, 'leaderboard'])->name('leaderboard');

// API Routes
Route::prefix('api/game')->group(function () {
    Route::get('/text', [GameController::class, 'getGameText']);
    Route::post('/save-result', [GameController::class, 'saveGameResult']);
    Route::get('/leaderboard', [GameController::class, 'getLeaderboardData']);
});
