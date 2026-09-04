2<x-guest-layout>
    <!-- Tactical Header -->
    <div class="mb-6 text-center">
        <div class="inline-flex items-center justify-center w-12 h-12 bg-amber-500 rounded-xl text-slate-900 text-2xl font-black shadow-lg shadow-amber-500/20 mb-2">
            🎖️
        </div>
        <h2 class="text-2xl font-black uppercase tracking-wider text-gray-900 dark:text-gray-100">
            Enlist Commander
        </h2>
        <p class="text-xs font-semibold uppercase tracking-widest text-amber-600 dark:text-amber-400">
            Salpakan Operations
        </p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Commander Name')" />
            <x-text-input id="name" class="block mt-1 w-full focus:border-amber-500 focus:ring-amber-500" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Gen. Antonio Luna" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email Address')" />
            <x-text-input id="email" class="block mt-1 w-full focus:border-amber-500 focus:ring-amber-500" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="commander@salpakan.ph" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Security Clearance (Password)')" />

            <x-text-input id="password" class="block mt-1 w-full focus:border-amber-500 focus:ring-amber-500"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Clearance')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full focus:border-amber-500 focus:ring-amber-500"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-6 pt-2 border-t border-gray-100 dark:border-gray-800">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-amber-500 dark:hover:text-amber-400 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4 bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold focus:ring-amber-500">
                {{ __('Enlist Now') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>