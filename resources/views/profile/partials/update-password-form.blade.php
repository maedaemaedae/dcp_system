<section class="max-w-2xl mx-auto bg-white dark:bg-gray-800/90 backdrop-blur-md rounded-2xl shadow-lg px-8 py-10 space-y-8">
    <!-- Header -->
    <header>
        <h2 class="text-xl font-semibold text-gray-900 dark:text-white tracking-tight">
            {{ __('Update Password') }}
        </h2>
        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <!-- Form -->
    <form method="POST" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Current Password -->
        <div>
            <label for="current_password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                {{ __('Current Password') }}
            </label>
            <input id="current_password" name="current_password" type="password"
                   class="mt-2 block w-full px-4 py-2 bg-gray-50 dark:bg-gray-700 text-sm text-gray-900 dark:text-white border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-[#4A90E2] focus:border-[#4A90E2]"
                   autocomplete="current-password" required>
            @if ($errors->updatePassword->has('current_password'))
                <p class="mt-2 text-sm text-red-500">
                    {{ $errors->updatePassword->first('current_password') }}
                </p>
            @endif
        </div>

        <!-- New Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                {{ __('New Password') }}
            </label>
            <input id="password" name="password" type="password"
                   class="mt-2 block w-full px-4 py-2 bg-gray-50 dark:bg-gray-700 text-sm text-gray-900 dark:text-white border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-[#4A90E2] focus:border-[#4A90E2]"
                   autocomplete="new-password" required>
            @if ($errors->updatePassword->has('password'))
                <p class="mt-2 text-sm text-red-500">
                    {{ $errors->updatePassword->first('password') }}
                </p>
            @endif
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                {{ __('Confirm Password') }}
            </label>
            <input id="password_confirmation" name="password_confirmation" type="password"
                   class="mt-2 block w-full px-4 py-2 bg-gray-50 dark:bg-gray-700 text-sm text-gray-900 dark:text-white border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-[#4A90E2] focus:border-[#4A90E2]"
                   autocomplete="new-password" required>
            @if ($errors->updatePassword->has('password_confirmation'))
                <p class="mt-2 text-sm text-red-500">
                    {{ $errors->updatePassword->first('password_confirmation') }}
                </p>
            @endif
        </div>

        <!-- Save Button -->
        <div class="flex items-center gap-4">
            <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-[#4A90E2] hover:bg-[#357ABD] text-white text-sm font-medium rounded-md focus:outline-none focus:ring-2 transition">
                {{ __('Save Changes') }}
            </button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition
                   x-init="setTimeout(() => show = false, 2000)"
                   class="text-sm text-green-600 dark:text-green-400">
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>
