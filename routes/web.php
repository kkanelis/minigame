<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;

// Welcome page
Route::get('/', function () {
    return view('welcome');
});

// Game routes
Route::get('/game', [GameController::class, 'index'])->name('game');
Route::get('/memory', function () {
    return view('memory-card');
})->name('memory');
Route::get('/leaderboard', [GameController::class, 'leaderboard'])->name('leaderboard');

// API Routes
Route::post('/api/game-result', [GameController::class, 'saveGameResult']);
Route::post('/api/memory-result', [GameController::class, 'saveMemoryResult']);
Route::get('/api/game/text', [GameController::class, 'getGameText']);
Route::get('/api/leaderboard', [GameController::class, 'getLeaderboardData']);
Route::get('/api/leaderboard/typing/{difficulty}', [GameController::class, 'getTypingLeaderboard']);
Route::get('/api/leaderboard/memory/{difficulty}', [GameController::class, 'getMemoryLeaderboard']);
