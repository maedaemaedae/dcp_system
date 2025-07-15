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

    <!-- Toast Notification for Password Update -->
    @if (session('password_success'))
        <div 
            x-data="{ show: true }" 
            x-init="setTimeout(() => show = false, 5000)" 
            x-show="show" 
            x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="opacity-0 -translate-y-4 scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
            x-transition:leave="transition ease-in duration-200 transform"
            x-transition:leave-start="opacity-100 translate-y-0 scale-100"
            x-transition:leave-end="opacity-0 -translate-y-4 scale-95"
            class="fixed top-6 left-1/2 transform -translate-x-1/2 z-50 
                   bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg 
                   text-sm flex items-center gap-2"
        >
            <i class="fa-solid fa-circle-check"></i>
            {{ session('password_success') }}
        </div>
    @endif

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
        <div class="relative">
            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                {{ __('New Password') }}
            </label>
            <input id="password" name="password" type="password"
                   class="mt-2 block w-full px-4 py-2 bg-gray-50 dark:bg-gray-700 text-sm text-gray-900 dark:text-white border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-[#4A90E2] focus:border-[#4A90E2] pr-10"
                   autocomplete="new-password" required>
            <span class="absolute right-3 top-10 text-[#2D9CDB] pointer-events-none"><i class="fa-solid fa-pencil"></i></span>
            <!-- Password Checklist -->
            <ul class="text-xs text-gray-600 dark:text-gray-400 mt-2 space-y-1" id="passwordChecklist">
                <li class="flex items-center gap-2">
                    <input type="checkbox" id="lengthCheck" class="accent-[#4A90E2] w-4 h-4 rounded" disabled>
                    <label for="lengthCheck">At least 8 characters</label>
                </li>
                <li class="flex items-center gap-2">
                    <input type="checkbox" id="lowercaseCheck" class="accent-[#4A90E2] w-4 h-4 rounded" disabled>
                    <label for="lowercaseCheck">Contains lowercase letter</label>
                </li>
                <li class="flex items-center gap-2">
                    <input type="checkbox" id="uppercaseCheck" class="accent-[#4A90E2] w-4 h-4 rounded" disabled>
                    <label for="uppercaseCheck">Contains uppercase letter</label>
                </li>
                <li class="flex items-center gap-2">
                    <input type="checkbox" id="numberCheck" class="accent-[#4A90E2] w-4 h-4 rounded" disabled>
                    <label for="numberCheck">Contains a number</label>
                </li>
                <li class="flex items-center gap-2">
                    <input type="checkbox" id="symbolCheck" class="accent-[#4A90E2] w-4 h-4 rounded" disabled>
                    <label for="symbolCheck">Contains a symbol (!@#$%)</label>
                </li>
            </ul>
            @if ($errors->updatePassword->has('password'))
                <p class="mt-2 text-sm text-red-500">
                    {{ $errors->updatePassword->first('password') }}
                </p>
            @endif
        </div>

        <!-- Confirm Password -->
        <div class="relative">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                {{ __('Confirm Password') }}
            </label>
            <input id="password_confirmation" name="password_confirmation" type="password"
                   class="mt-2 block w-full px-4 py-2 bg-gray-50 dark:bg-gray-700 text-sm text-gray-900 dark:text-white border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-[#4A90E2] focus:border-[#4A90E2] pr-10"
                   autocomplete="new-password" required>
            <span class="absolute right-3 top-10 text-[#2D9CDB] pointer-events-none"><i class="fa-solid fa-pencil"></i></span>
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

<script>
document.addEventListener('DOMContentLoaded', function () {
    const passwordInput = document.getElementById('password');
    const lengthCheck = document.getElementById('lengthCheck');
    const lowercaseCheck = document.getElementById('lowercaseCheck');
    const uppercaseCheck = document.getElementById('uppercaseCheck');
    const numberCheck = document.getElementById('numberCheck');
    const symbolCheck = document.getElementById('symbolCheck');

    passwordInput.addEventListener('input', () => {
        const value = passwordInput.value;
        lengthCheck.checked = value.length >= 8;
        lowercaseCheck.checked = /[a-z]/.test(value);
        uppercaseCheck.checked = /[A-Z]/.test(value);
        numberCheck.checked = /\d/.test(value);
        symbolCheck.checked = /[!@#$%^&*]/.test(value);
    });
});
</script>
