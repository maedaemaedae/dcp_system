<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

<a href="{{ route('login') }}" 
   class="fixed top-6 left-6 flex items-center text-[#4A90E2] hover:text-[#357ABD] text-sm font-medium group transition">
    <svg xmlns="http://www.w3.org/2000/svg" 
         class="h-4 w-4 mr-1 transition-transform duration-300 group-hover:-translate-x-1" 
         fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
    </svg>
    Back to Login
</a>

<div class="bg-white shadow-lg rounded-xl p-8 max-w-md w-full">
    <h1 class="text-2xl font-semibold text-center text-gray-800 mb-6">Reset Password</h1>

    <form method="POST" action="{{ route('password.store') }}" id="resetForm" novalidate>
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email', $request->email) }}" required
                   class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
            <p id="emailError" class="text-sm text-red-600 hidden">Please enter a valid email.</p>
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-600" />
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">New Password</label>
            <input id="password" name="password" type="password" required minlength="8"
                   class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
            <p id="passwordError" class="text-sm text-red-600 hidden">Password must be at least 8 characters.</p>
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-600" />
        </div>

        <!-- Confirm Password -->
        <div class="mb-6">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
            <input id="password_confirmation" name="password_confirmation" type="password" required
                   class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
            <p id="confirmError" class="text-sm text-red-600 hidden">Passwords do not match.</p>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-sm text-red-600" />
        </div>

        <button type="submit"
                class="w-full bg-[#4A90E2] hover:bg-[#357ABD] text-white font-medium py-2 px-4 rounded-md transition duration-200">
            Reset Password
        </button>
    </form>
</div>

<script>
    document.getElementById('resetForm').addEventListener('submit', function (e) {
        let valid = true;

        const email = document.getElementById('email');
        const password = document.getElementById('password');
        const confirm = document.getElementById('password_confirmation');

        const emailError = document.getElementById('emailError');
        const passwordError = document.getElementById('passwordError');
        const confirmError = document.getElementById('confirmError');

        // Reset visibility
        emailError.classList.add('hidden');
        passwordError.classList.add('hidden');
        confirmError.classList.add('hidden');

        // Email validation
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email.value)) {
            emailError.classList.remove('hidden');
            valid = false;
        }

        // Password length
        if (password.value.length < 8) {
            passwordError.classList.remove('hidden');
            valid = false;
        }

        // Password match
        if (password.value !== confirm.value) {
            confirmError.classList.remove('hidden');
            valid = false;
        }

        if (!valid) e.preventDefault();
    });
</script>

</body>
</html>
