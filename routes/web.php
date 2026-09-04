<?php

use App\Http\Controllers\{ProfileController, GameController};
use Illuminate\Support\Facades\Route;
use App\Models\Game;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $games = Game::where('status', 'WAITING')
            ->where('player1_id', '!=', Auth::id())
            ->get();

    $myGames = Game::where('player1_id', Auth::id())
            ->orWhere('player2_id', Auth::id())
            ->get();

    return view('dashboard',  compact('games', 'myGames'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/lobby', [GameController::class, 'index'])->name('lobby');
    Route::post('/game/create', [GameController::class, 'create'])->name('game.create');
    Route::post('/game/{game}/join', [GameController::class, 'join'])->name('game.join');
    Route::get('/game/{game}', [GameController::class, 'show'])->name('game.show');

    // API state management
    Route::get('/game/{game}/state', [GameController::class, 'getState']);
    Route::post('/game/{game}/move', [GameController::class, 'makeMove']);
});

require __DIR__.'/auth.php';
