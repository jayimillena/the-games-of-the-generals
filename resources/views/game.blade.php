<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center max-w-7xl mx-auto">
            <div class="flex items-center gap-3">
                <a href="{{ route('lobby') }}" class="text-sm font-semibold text-gray-500 hover:text-amber-500 dark:text-gray-400 transition flex items-center gap-1">
                    ← {{ __('Exit War Room') }}
                </a>
                <span class="text-gray-300 dark:text-gray-700">|</span>
                <h2 class="font-bold text-xl text-gray-800 dark:text-gray-200 leading-tight flex items-center gap-2">
                    <span>⚔️</span> Match #{{ $game->id }}
                </h2>
            </div>

            <div class="flex items-center gap-2">
                <span class="text-xs font-bold uppercase tracking-wider px-3 py-1 rounded-full bg-amber-500/10 text-amber-600 dark:text-amber-400 border border-amber-500/20">
                    Commander Player {{ $playerNum }}
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Match Status Header -->
            <div class="bg-white dark:bg-gray-800 p-4 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 text-center">
                <p class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Tactical Status</p>
                <div id="statusMessage" class="text-lg font-black text-amber-600 dark:text-amber-400 mt-1">
                    Press "Position Your Forces" to begin deployment
                </div>
            </div>

            <!-- Main Game Container -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 flex flex-col items-center">
                
                <!-- Game Board -->
                <div id="gameBoard" class="board border-2 border-gray-300 dark:border-gray-700 rounded-lg shadow-inner"></div>

                <!-- Game Action Controls -->
                <div id="buttonContainer" class="flex gap-3 mt-6">
                    <button id="actionButton" class="px-6 py-2.5 bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold rounded-lg shadow transition">
                        Position Your Forces
                    </button>
                </div>
            </div>

        </div>
    </div>

    <!-- Pass Laravel Game Session Data to Frontend Script -->
    <script>
        window.gameConfig = {
            gameId: {{ $game->id }},
            userId: {{ Auth::id() }},
            playerNum: {{ $playerNum }},
            csrfToken: "{{ csrf_token() }}"
        };
    </script>
</x-app-layout>