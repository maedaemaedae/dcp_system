<section class="max-w-3xl mx-auto bg-white/80 dark:bg-gray-900/60 backdrop-blur-lg border border-gray-200 dark:border-gray-700 rounded-2xl shadow-2xl px-10 py-12 space-y-10 transition-all">

    <!-- Header -->
    <header class="text-center">
        <h2 class="text-3xl font-bold text-gray-900 dark:text-white tracking-tight">
            {{ __('Profile Information') }}
        </h2>
        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <!-- Verification Form -->
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <!-- Profile Update Form -->
    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

       <!-- Name Field -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">
                    {{ __('Name') }}
                </label>
                <input id="name" name="name" type="text"
                    class="w-full px-4 py-2 bg-white/80 dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-[#4A90E2] focus:border-[#4A90E2] text-sm text-gray-900 dark:text-white placeholder:text-gray-400"
                    value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                @error('name')
                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email Field -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">
                    {{ __('Email') }}
                </label>
                <input id="email" name="email" type="email"
                    class="w-full px-4 py-2 bg-white/80 dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-[#4A90E2] focus:border-[#4A90E2] text-sm text-gray-900 dark:text-white placeholder:text-gray-400"
                    value="{{ old('email', $user->email) }}" required autocomplete="username">
                @error('email')
                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                @enderror

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="mt-4 bg-yellow-50 dark:bg-yellow-900/30 border-l-4 border-yellow-400 p-4 rounded-md shadow-inner">
                        <p class="text-sm text-yellow-800 dark:text-yellow-200">
                            {{ __('Your email address is unverified.') }}
                            <button form="send-verification"
                                class="ml-1 underline font-medium text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-white transition">
                                {{ __('Click here to re-send the verification email.') }}
                            </button>
                        </p>
                    </div>
                @endif
            </div>


        <!-- Save Button -->
        <div class="flex items-center gap-4">
            <button type="submit"
                class="inline-flex items-center px-5 py-2.5 bg-[#4A90E2] hover:bg-[#357ABD] text-white font-semibold text-sm rounded-lg shadow-md transition focus:outline-none focus:ring-2 focus:ring-offset-2">
                {{ __('Save Changes') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition
                   x-init="setTimeout(() => show = false, 2500)"
                   class="text-sm font-medium text-green-600 dark:text-green-400">
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>
