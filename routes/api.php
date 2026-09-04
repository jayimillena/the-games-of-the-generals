<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;

Route::post('/game/move', [GameController::class, 'validateMove']);