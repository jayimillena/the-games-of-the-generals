<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Salpakan - Game of the Generals</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600,800&display=swap" rel="stylesheet" />

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-900 text-slate-100 font-sans antialiased min-h-screen flex flex-col justify-between selection:bg-amber-500 selection:text-slate-900">

    <!-- Header Navigation -->
    <header class="w-full max-w-7xl mx-auto px-6 py-6 flex justify-between items-center border-b border-slate-800">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-amber-500 rounded-lg flex items-center justify-center text-slate-900 font-extrabold text-xl shadow-lg shadow-amber-500/20">
                ⚔️
            </div>
            <span class="text-2xl font-black tracking-wider uppercase bg-gradient-to-r from-amber-400 to-amber-600 bg-clip-text text-transparent">
                Salpakan
            </span>
        </div>

        <nav class="flex items-center gap-4">
            @if (Route::has('login'))
                @auth
                    <a href="{{ route('lobby') }}" class="px-5 py-2.5 rounded-lg bg-amber-500 hover:bg-amber-400 text-slate-900 font-bold transition shadow-md hover:shadow-amber-500/20">
                        Go to Lobby
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-slate-300 hover:text-white font-semibold transition px-3 py-2">
                        Log In
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="px-5 py-2.5 rounded-lg bg-slate-800 hover:bg-slate-700 text-amber-400 border border-amber-500/30 font-semibold transition">
                            Register
                        </a>
                    @endif
                @endauth
            @endif
        </nav>
    </header>

    <!-- Main Hero Section -->
    <main class="w-full max-w-7xl mx-auto px-6 py-16 flex-1 flex flex-col lg:flex-row items-center justify-between gap-12">
        <!-- Hero Text -->
        <div class="max-w-2xl text-center lg:text-left space-y-6">
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-slate-800 border border-slate-700 text-amber-400 text-xs font-semibold uppercase tracking-widest">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                Classic Filipino Tactical Warfare
            </div>

            <h1 class="text-4xl sm:text-6xl font-black tracking-tight text-white leading-tight">
                Outsmart, Outmaneuver, and <span class="text-amber-500 underline decoration-amber-500/40">Eliminate.</span>
            </h1>

            <p class="text-slate-400 text-lg sm:text-xl font-normal leading-relaxed">
                Experience the authentic Game of the Generals built with modern Laravel logic. Deploy your forces with strict backend fog-of-war, hidden ranks, and real-time strategic combat.
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start pt-4">
                @auth
                    <a href="{{ route('lobby') }}" class="px-8 py-4 rounded-xl bg-amber-500 hover:bg-amber-400 text-slate-950 font-extrabold text-lg transition text-center shadow-lg shadow-amber-500/25">
                        Enter Battle Lobby →
                    </a>
                @else
                    <a href="{{ route('register') }}" class="px-8 py-4 rounded-xl bg-amber-500 hover:bg-amber-400 text-slate-950 font-extrabold text-lg transition text-center shadow-lg shadow-amber-500/25">
                        Create Commander Account
                    </a>
                    <a href="{{ route('login') }}" class="px-8 py-4 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-200 border border-slate-700 font-bold text-lg transition text-center">
                        Commander Login
                    </a>
                @endauth
            </div>
        </div>

        <!-- Preview Card/Board Graphic -->
        <div class="w-full max-w-md bg-slate-800/80 border border-slate-700/80 rounded-2xl p-6 shadow-2xl backdrop-blur-sm space-y-6">
            <div class="flex justify-between items-center pb-4 border-b border-slate-700">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Tactical Match Briefing</span>
                <span class="text-xs px-2.5 py-1 rounded bg-amber-500/10 text-amber-400 font-semibold border border-amber-500/20">Laravel 13 Engine</span>
            </div>

            <!-- Visual Mock Grid -->
        
            <div class="space-y-2 text-xs text-slate-400">
                <div class="flex items-center gap-2">
                    <span class="text-emerald-400">✓</span> Server-side rank masking prevents client-side leaks.
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-emerald-400">✓</span> Automated elimination arbiter (5-Star > Officers > Spy > Private > Spy).
                </div>
            </div>
        </div>
    </main>

    <!-- Key Game Mechanics Grid -->
    <section class="w-full max-w-7xl mx-auto px-6 py-12 border-t border-slate-800">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-slate-800/40 border border-slate-800 p-6 rounded-xl space-y-2">
                <div class="text-2xl mb-2">👁️‍🗨️</div>
                <h3 class="text-white font-bold text-lg">True Fog-of-War</h3>
                <p class="text-slate-400 text-sm">Opponent ranks are completely hidden from the browser network stream to guarantee unbiased strategic gameplay.</p>
            </div>

            <div class="bg-slate-800/40 border border-slate-800 p-6 rounded-xl space-y-2">
                <div class="text-2xl mb-2">⚖️</div>
                <h3 class="text-white font-bold text-lg">Backend Arbiter</h3>
                <p class="text-slate-400 text-sm">Combat is calculated by `SalpakanEngine.php`. Eliminates pieces according to official hierarchy rules behind the scenes.</p>
            </div>

            <div class="bg-slate-800/40 border border-slate-800 p-6 rounded-xl space-y-2">
                <div class="text-2xl mb-2">🏆</div>
                <h3 class="text-white font-bold text-lg">Multiple Victory Paths</h3>
                <p class="text-slate-400 text-sm">Capture the enemy flag, maneuver your flag to the opposite end, or force a surrender when the opponent is out of moves.</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="w-full border-t border-slate-800 py-6 text-center text-xs text-slate-500">
        <p>Salpakan (Game of the Generals) • Laravel v{{ illuminate\foundation\application::VERSION }} (PHP v{{ PHP_VERSION }})</p>
    </footer>

</body>
</html>