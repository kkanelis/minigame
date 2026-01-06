<?php

namespace App\Http\Controllers;

use App\Models\GameResult;
use App\Services\GameTextService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GameController extends Controller
{
    public function index(): View
    {
        return view('game');
    }

    public function leaderboard(): View
    {
        $results = GameResult::orderBy('created_at', 'desc')->limit(100)->get();

        $leaderboard = [
            'easy' => GameResult::where('difficulty', 'easy')->orderByDesc('words_per_minute')->limit(10)->get(),
            'medium' => GameResult::where('difficulty', 'medium')->orderByDesc('words_per_minute')->limit(10)->get(),
            'hard' => GameResult::where('difficulty', 'hard')->orderByDesc('words_per_minute')->limit(10)->get(),
            'hardcore' => GameResult::where('difficulty', 'hardcore')->orderByDesc('words_per_minute')->limit(10)->get(),
        ];

        return view('leaderboard', ['leaderboard' => $leaderboard]);
    }

    public function getGameText(Request $request): JsonResponse
    {
        $difficulty = $request->query('difficulty', 'easy');

        $validDifficulties = ['easy', 'medium', 'hard', 'hardcore'];
        if (!in_array($difficulty, $validDifficulties)) {
            $difficulty = 'easy';
        }

        $text = GameTextService::getTextByDifficulty($difficulty);

        return response()->json([
            'text' => $text,
            'difficulty' => $difficulty,
        ]);
    }

    public function saveGameResult(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'nickname' => 'required|string|max:50',
            'difficulty' => 'required|string|in:easy,medium,hard,hardcore',
            'time_taken' => 'required|integer|min:1',
            'words_per_minute' => 'required|integer|min:0',
            'accuracy' => 'required|integer|min:0|max:100',
        ]);

        $result = GameResult::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Game result saved successfully!',
            'result' => $result,
        ]);
    }

    public function saveMemoryResult(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'nickname' => 'nullable|string|max:50',
            'time' => 'required|integer|min:0',
            'moves' => 'required|integer|min:0',
        ]);

        $nickname = $validated['nickname'] ?? 'guest';

        $result = GameResult::create([
            'nickname' => $nickname,
            'difficulty' => 'memory',
            'time_taken' => (int) $validated['time'],
            'words_per_minute' => (int) $validated['moves'],
            'accuracy' => 100,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Memory result saved successfully!',
            'result' => $result,
        ]);
    }

    public function getLeaderboardData(Request $request): JsonResponse
    {
        $difficulty = $request->query('difficulty');

        if ($difficulty) {
            $leaderboard = GameResult::where('difficulty', $difficulty)
                ->orderByDesc('words_per_minute')
                ->limit(10)
                ->get();
        } else {
            $leaderboard = GameResult::orderBy('created_at', 'desc')->limit(50)->get();
        }

        return response()->json($leaderboard);
    }
}
