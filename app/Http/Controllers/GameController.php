<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Services\SalpakanEngine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    // Lobby: Create or join game
    public function index()
    {
        $games = Game::where('status', 'WAITING')
            ->where('player1_id', '!=', Auth::id())
            ->get();

        $myGames = Game::where('player1_id', Auth::id())
            ->orWhere('player2_id', Auth::id())
            ->get();

        return view('lobby', compact('games', 'myGames'));
    }

    public function create()
    {
        $game = Game::create([
            'player1_id' => Auth::id(),
            'status' => 'WAITING',
            'current_turn_player_id' => Auth::id()
        ]);

        return redirect()->route('game.show', $game->id);
    }

    public function join(Game $game)
    {
        if ($game->player2_id === null && $game->player1_id !== Auth::id()) {
            $game->update([
                'player2_id' => Auth::id(),
                'status' => 'SETUP'
            ]);
        }

        return redirect()->route('game.show', $game->id);
    }

    public function show(Game $game)
    {
        // Restrict access to match participants only
        if (Auth::id() !== $game->player1_id && Auth::id() !== $game->player2_id) {
            abort(403, 'Unauthorized access to this game room.');
        }

        $playerNum = (Auth::id() === $game->player1_id) ? 1 : 2;

        return view('game', compact('game', 'playerNum'));
    }

    public function getState(Game $game)
    {
        return response()->json([
            'status' => $game->status,
            'current_turn' => $game->current_turn_player_id,
            'board_state' => $game->board_state,
            'winner_id' => $game->winner_id,
        ]);
    }

    public function makeMove(Request $request, Game $game, SalpakanEngine $engine)
    {
        if ($game->current_turn_player_id !== Auth::id() || $game->status !== 'PLAYING') {
            return response()->json(['message' => 'Not your turn or game inactive'], 403);
        }

        $validated = $request->validate([
            'startX' => 'required|integer',
            'startY' => 'required|integer',
            'endX' => 'required|integer',
            'endY' => 'required|integer',
            'attackerRank' => 'required|string',
            'defenderRank' => 'nullable|string',
            'newBoardState' => 'required|array'
        ]);

        if (!$engine->isValidMove($validated['startX'], $validated['startY'], $validated['endX'], $validated['endY'])) {
            return response()->json(['message' => 'Invalid move logic'], 422);
        }

        $nextTurn = (Auth::id() === $game->player1_id) ? $game->player2_id : $game->player1_id;

        $game->update([
            'board_state' => $validated['newBoardState'],
            'current_turn_player_id' => $nextTurn
        ]);

        return response()->json(['success' => true]);
    }
}