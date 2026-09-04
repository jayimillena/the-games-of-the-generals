<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Game extends Model
{
    protected $fillable = [
        'player1_id',
        'player2_id',
        'winner_id',
        'current_turn_player_id',
        'status',
        'board_state'
    ];

    protected $casts = [
        'board_state' => 'array',
    ];

    public function player1(): BelongsTo
    {
        return $this->belongsTo(User::class, 'player1_id');
    }

    public function player2(): BelongsTo
    {
        return $this->belongsTo(User::class, 'player2_id');
    }
}