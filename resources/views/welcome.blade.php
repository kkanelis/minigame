@extends('layouts.app')

@section('title', 'Sākums - Mazās spēles')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
    <!-- Hero Section -->
    <div class="text-center mb-20">
        <h1 class="text-5xl md:text-6xl font-bold text-white mb-6">Sveicināts, Mazajās spēlēs</h1>
        <p class="text-xl text-slate-400 mb-8 max-w-2xl mx-auto">Jautras un interesantas interneta spēles. Spēlē uzreiz, bez nekādām lejuplādēm.</p>
    </div>

    <!-- Games Grid -->
    <div class="mb-20">
        <h2 class="text-center text-3xl font-bold text-white mb-8">Pieejamās spēles</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 md:gap-6">
            <!-- Game Card 1 -->
            <div class="bg-slate-800 border border-slate-700 rounded-lg p-6 hover:border-blue-500 transition-all">
                <div class="w-full h-40 bg-slate-700 rounded mb-4 flex items-center justify-center">
                    <span class="text-4xl">🃏</span>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">Atmiņu kārts salikšana</h3>
                <p class="text-slate-400 mb-4">Īss apraksts: Atrasts divas vienādas kārtis kāmēr tās ir paslēptas</p>
                <button class="w-full py-2 bg-blue-600 hover:bg-blue-700 text-white rounded transition-all">Spēlēt tagad</button>
            </div>

            <!-- Game Card 2 -->
            <div class="bg-slate-800 border border-slate-700 rounded-lg p-6 hover:border-purple-500 transition-all">
                <div class="w-full h-40 bg-slate-700 rounded mb-4 flex items-center justify-center">
                    <span class="text-4xl">🎹</span>
                </div>
                <h3 class="text-xl font-bold text-white mb-2">Rakstīšanas ātrums</h3>
                <p class="text-slate-400 mb-4">Īss apraksts: Pārbaudi savu rakstīšanas ātrumu spēlē</p>
                <a href="/game" class="w-full py-2 bg-purple-600 hover:bg-purple-700 text-white rounded transition-all block text-center">Spēlēt tagad</a>
            </div>
        </div>
    </div>
</div>
@endsection
