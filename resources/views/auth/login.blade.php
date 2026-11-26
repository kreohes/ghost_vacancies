<x-guest-layout>
    <h1 class="font-display text-3xl font-bold">Welcome back</h1>
    <p class="mt-1 mb-6 text-moss">Log in to report what happened after you applied.</p>

    <!-- Session Status -->
    <x-breeze.auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-breeze.input-label for="email" value="Email" />
            <x-breeze.text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-breeze.input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-breeze.input-label for="password" value="Password" />

            <x-breeze.text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-breeze.input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded-sm border-crust accent-dusk" name="remember">
                <span class="ms-2 text-sm text-moss">Remember me</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-moss hover:text-dusk rounded-md focus:outline-hidden focus:ring-2 focus:ring-offset-2 focus:ring-fern" href="{{ route('password.request') }}">
                    Forgot your password?
                </a>
            @endif

            <x-breeze.primary-button class="ms-3">
                Log in
            </x-breeze.primary-button>
        </div>
    </form>
</x-guest-layout>
