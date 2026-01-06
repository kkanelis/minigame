@extends('layouts.app')

@section('title', 'Atmiņas kāršu spēle')

@section('content')
    <div class="h-screen bg-gradient-to-b from-slate-900 to-slate-950 flex flex-col m-0 p-0 pt-16">

        <!-- Game Area -->
        <div class="flex-1 bg-gradient-to-b from-slate-900 to-slate-950 flex flex-col p-3">
            <p class="text-center text-slate-400 text-sm mb-3">Atrodi visas pāra kārtis!</p>

            <div class="flex items-center justify-between mb-3 px-2">
                <div class="space-x-2">
                    <button id="startBtn"
                        class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded text-sm font-bold">Sākt</button>
                    <button id="restartBtn"
                        class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded text-sm font-bold">Atjaunot</button>
                </div>
                <div class="flex gap-4 text-xs">
                    <div class="text-center">
                        <p class="text-slate-400">Laiks</p>
                        <p id="timer" class="text-lg font-bold text-orange-400">0s</p>
                    </div>
                    <div class="text-center">
                        <p class="text-slate-400">Gājieni</p>
                        <p id="moves" class="text-lg font-bold text-blue-400">0</p>
                    </div>
                    <div class="text-center">
                        <p class="text-slate-400">Pāra</p>
                        <p id="pairsLeft" class="text-lg font-bold text-green-400">8</p>
                    </div>
                </div>
            </div>

            <div class="flex-1 flex items-center justify-center px-2">
                <div id="board" class="grid"
                    style="grid-template-columns: repeat(4, 1fr); gap: 5px; width: 100%; max-width: 400px; max-height: 100%; aspect-ratio: 1;">
                </div>
            </div>

            <div id="message" class="text-center text-white text-sm"></div>
        </div>
    </div>

@endsection