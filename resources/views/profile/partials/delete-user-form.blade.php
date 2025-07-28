<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Account</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="bg-gray-100 dark:bg-gray-900">
    <section class="space-y-8 bg-white dark:bg-gray-900 rounded-xl shadow-lg p-6 border border-gray-200 dark:border-gray-700 max-w-xl mx-auto mt-8">
        <header>
            <h2 class="text-2xl font-bold text-red-600 flex items-center gap-2">
                <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5-4h4a2 2 0 012 2v2H7V5a2 2 0 012-2z" />
                </svg>
                Delete Account
            </h2>
            <p class="mt-2 text-base text-gray-700 dark:text-gray-300 leading-relaxed">
                Once your account is deleted, all of its resources and data will be permanently removed. Before proceeding, download anything you wish to keep.
            </p>
        </header>

        <!-- Trigger Delete Button -->
        <div class="flex justify-end">
            <button
                type="button"
                class="px-6 py-2 text-base rounded-lg transition duration-150 hover:scale-105 shadow hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-red-400 bg-red-600 text-white font-semibold flex items-center gap-2"
                x-data=""
                x-on:click.prevent="document.getElementById('deleteModal').classList.remove('hidden')"
            >
                <i class="fa-solid fa-trash-can mr-2"></i>
                Delete Account
            </button>
        </div>

        <!-- Modal -->
        <div id="deleteModal" class="fixed left-0 right-0 z-50 hidden flex items-center justify-center bg-black bg-opacity-50" style="top: 49px; bottom: 0;">
            <form method="post" action="{{ route('profile.destroy') }}" class="p-8 space-y-6 bg-white dark:bg-gray-900 rounded-xl shadow-xl border border-gray-200 dark:border-gray-700 max-w-md mx-auto relative">
                @csrf
                @method('delete')

                <!-- Modal Header -->
                <div class="text-center">
                    <h2 class="text-xl font-bold text-red-600 flex items-center justify-center gap-2">
                        <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5-4h4a2 2 0 012 2v2H7V5a2 2 0 012-2z" />
                        </svg>
                        Are you absolutely sure?
                    </h2>
                    <p class="mt-3 text-base text-gray-700 dark:text-gray-300 leading-relaxed">
                        Deleting your account is permanent and cannot be undone. This will erase all data associated with your account. Please enter your password to continue.
                    </p>
                    <button type="button" onclick="document.getElementById('deleteModal').classList.add('hidden')" class="absolute top-3 right-3 text-gray-400 hover:text-gray-700 text-2xl font-bold leading-none">&times;</button>
                </div>

                <!-- Password Field -->
                <div>
                    <label for="password" class="sr-only">Password</label>
                    <div class="relative" x-data="{ show: false }">
    <input
        id="password"
        name="password"
        :type="show ? 'text' : 'password'"
        class="mt-1 block w-full bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-2 focus:ring-red-500 focus:border-red-500 dark:text-white pl-10 pr-10 py-2 text-base placeholder-gray-400 transition focus:outline-none"
        placeholder="Enter your password"
        autocomplete="current-password"
        required
    />
    <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 pointer-events-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
            viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 11c.552 0 1 .448 1 1v1h-2v-1c0-.552.448-1 1-1zm6 0V9a6 6 0 10-12 0v2H4v10h16V11h-2zm-2 0H8V9a4 4 0 118 0v2z" />
        </svg>
    </span>

    <button
        type="button"
        class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 focus:outline-none"
        @click="show = !show"
        :aria-label="show ? 'Hide password' : 'Show password'"
    >
        <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
            viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
        </svg>
        <svg x-show="show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
            viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.964 9.964 0 012.206-3.592m1.591-1.41A9.965 9.965 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.97 9.97 0 01-4.293 5.202M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 3l18 18" />
        </svg>
    </button>
</div>

                    @if ($errors->userDeletion->has('password'))
                        <p class="text-red-500 text-sm mt-2">{{ $errors->userDeletion->first('password') }}</p>
                    @endif
                </div>

                <!-- Modal Actions -->
                <div class="flex justify-end gap-4 mt-6">
                    <button
                        type="button"
                        onclick="document.getElementById('deleteModal').classList.add('hidden')"
                        class="px-5 py-2 rounded-md text-base bg-gray-200 hover:bg-gray-300 text-gray-800 transition"
                    >
                        Cancel
                    </button>
                    <button
                        type="submit"
                        class="px-5 py-2 bg-red-600 hover:bg-red-700 text-white text-base font-semibold rounded-md transition shadow hover:shadow-lg flex items-center gap-2"
                    >
                        <i class="fa-solid fa-trash-can mr-2"></i>
                        Delete Account
                    </button>
                </div>
            </form>
        </div>
    </section>
    <script>

    function togglePassword() {
        const input = document.getElementById("password");
        const eye = document.getElementById("eyeIcon");
        const eyeOff = document.getElementById("eyeOffIcon");

        if (input.type === "password") {
            input.type = "text";
            eye.classList.add("hidden");
            eyeOff.classList.remove("hidden");
        } else {
            input.type = "password";
            eye.classList.remove("hidden");
            eyeOff.classList.add("hidden");
        }
    }

    // Optional: Close modal on ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === "Escape") {
            document.getElementById('deleteModal').classList.add('hidden');
        }
    });
</script>

</body>
</html>
