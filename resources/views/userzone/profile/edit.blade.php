<x-app-layout>
    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 space-y-6">
            <div class="mb-6">
                <h2 class="font-display text-4xl font-bold">
                Profile
                </h2>
            </div>

            <div class="p-4 sm:p-8 bg-white rounded-4xl">
                <div class="max-w-xl">
                    @include('userzone.profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white rounded-4xl">
                <div class="max-w-xl">
                    @include('userzone.profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white rounded-4xl">
                <div class="max-w-xl">
                    @include('userzone.profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
