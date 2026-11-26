<section>
    <header>
        <h2 class="font-display text-2xl font-semibold">
            Profile Information
        </h2>

        <p class="mt-1 text-sm text-moss">
            Update your account's profile information and email address.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-breeze.input-label for="name" value="Name" />
            <x-breeze.text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-breeze.input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-breeze.input-label for="email" value="Email" />
            <x-breeze.text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-breeze.input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-dusk">
                        Your email address is unverified.

                        <button form="send-verification" class="underline text-sm text-moss hover:text-dusk rounded-md focus:outline-hidden focus:ring-2 focus:ring-offset-2 focus:ring-fern">
                            Click here to re-send the verification email.
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-fern">
                            A new verification link has been sent to your email address.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-breeze.primary-button>Save</x-breeze.primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-moss"
                >Saved.</p>
            @endif
        </div>
    </form>
</section>
