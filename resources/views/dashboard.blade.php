<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-xl text-gray-800 dark:text-gray-200 leading-tight flex items-center gap-2">
                <span>⚔️</span> {{ __('Command Center Lobby') }}
            </h2>
            <form action="{{ route('game.create') }}" method="POST">
                @csrf
                <x-primary-button class="bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold border-none">
                    {{ __('+ Create Match') }}
                </x-primary-button>
            </form>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Quick Stats & Status Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white dark:bg-gray-800 p-5 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Commander Rank</p>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">{{ Auth::user()->name }}</h3>
                    </div>
                    <span class="text-2xl">🎖️</span>
                </div>

                <div class="bg-white dark:bg-gray-800 p-5 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Open Battles</p>
                        <h3 class="text-lg font-bold text-amber-600 dark:text-amber-400">{{ $games->count() }} Waiting</h3>
                    </div>
                    <span class="text-2xl">📡</span>
                </div>

                <div class="bg-white dark:bg-gray-800 p-5 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Active Campaign</p>
                        <h3 class="text-lg font-bold text-emerald-600 dark:text-emerald-400">{{ $myGames->where('status', 'PLAYING')->count() }} Engaged</h3>
                    </div>
                    <span class="text-2xl">⚡</span>
                </div>
            </div>

            <!-- Active Engagements -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 dark:border-gray-700">
                <div class="p-6">
                    <h3 class="text-base font-bold text-gray-900 dark:text-gray-100 mb-4 flex items-center gap-2">
                        <span>🚩</span> {{ __('Your Active Campaigns') }}
                    </h3>

                    <div class="space-y-3">
                        @forelse($myGames as $myGame)
                            <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-900/50 rounded-lg border border-gray-200 dark:border-gray-700">
                                <div>
                                    <div class="flex items-center gap-2">
                                        <span class="font-bold text-gray-900 dark:text-gray-100">Match #{{ $myGame->id }}</span>
                                        <span class="text-xs px-2 py-0.5 rounded font-bold uppercase
                                            {{ $myGame->status === 'PLAYING' ? 'bg-emerald-100 text-emerald-800 dark:bg-emerald-900/40 dark:text-emerald-400' : 'bg-amber-100 text-amber-800 dark:bg-amber-900/40 dark:text-amber-400' }}">
                                            {{ $myGame->status }}
                                        </span>
                                    </div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                        Opponent: {{ $myGame->player1_id === Auth::id() ? ($myGame->player2->name ?? 'Waiting for enemy...') : $myGame->player1->name }}
                                    </p>
                                </div>
                                <a href="{{ route('game.show', $myGame->id) }}">
                                    <x-secondary-button>
                                        {{ __('Enter War Room →') }}
                                    </x-secondary-button>
                                </a>
                            </div>
                        @empty
                            <p class="text-sm text-gray-500 dark:text-gray-400 py-2">{{ __('You have no active matches in progress.') }}</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Open Games Feed -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-xl border border-gray-100 dark:border-gray-700">
                <div class="p-6">
                    <h3 class="text-base font-bold text-gray-900 dark:text-gray-100 mb-4 flex items-center gap-2">
                        <span>🌐</span> {{ __('Available Open Battles') }}
                    </h3>

                    <div class="space-y-3">
                        @forelse($games as $game)
                            <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-900/50 rounded-lg border border-gray-200 dark:border-gray-700">
                                <div>
                                    <span class="font-bold text-gray-900 dark:text-gray-100">Battle #{{ $game->id }}</span>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                        Host Commander: <span class="text-amber-600 dark:text-amber-400 font-semibold">{{ $game->player1->name }}</span>
                                    </p>
                                </div>
                                <form action="{{ route('game.join', $game->id) }}" method="POST">
                                    @csrf
                                    <x-primary-button class="bg-emerald-600 hover:bg-emerald-500 text-white font-bold border-none">
                                        {{ __('Accept Challenge') }}
                                    </x-primary-button>
                                </form>
                            </div>
                        @empty
                            <div class="text-center py-8">
                                <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('No open battles currently requesting reinforcements.') }}</p>
                                <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">{{ __('Create a new game match above to start.') }}</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>