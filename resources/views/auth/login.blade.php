<x-guest-layout>
    <!-- Tactical Header -->
    <div class="mb-6 text-center">
        <div class="inline-flex items-center justify-center w-12 h-12 bg-amber-500 rounded-xl text-slate-900 text-2xl font-black shadow-lg shadow-amber-500/20 mb-2">
            ⚔️
        </div>
        <h2 class="text-2xl font-black uppercase tracking-wider text-gray-900 dark:text-gray-100">
            Commander Login
        </h2>
        <p class="text-xs font-semibold uppercase tracking-widest text-amber-600 dark:text-amber-400">
            Salpakan Operations
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full focus:border-amber-500 focus:ring-amber-500" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="commander@salpakan.ph" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full focus:border-amber-500 focus:ring-amber-500"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-amber-500 shadow-sm focus:ring-amber-500 dark:focus:ring-amber-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-between mt-6 pt-2 border-t border-gray-100 dark:border-gray-800">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-amber-500 dark:hover:text-amber-400 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Forgot password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3 bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold focus:ring-amber-500">
                {{ __('Enter Battle') }}
            </x-primary-button>
        </div>

        @if (Route::has('register'))
            <div class="mt-6 text-center text-xs text-gray-500 dark:text-gray-400">
                Need a command center account? 
                <a href="{{ route('register') }}" class="font-bold text-amber-600 dark:text-amber-400 hover:underline">
                    Register here
                </a>
            </div>
        @endif
    </form>
</x-guest-layout>