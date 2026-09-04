<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->foreignId('player1_id')->constrained('users');
            $table->foreignId('player2_id')->nullable()->constrained('users');
            $table->foreignId('winner_id')->nullable()->constrained('users');
            $table->integer('current_turn_player_id')->nullable();
            $table->enum('status', ['WAITING', 'SETUP', 'PLAYING', 'FINISHED'])->default('WAITING');
            $table->json('board_state')->nullable(); // Stores position of pieces
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};