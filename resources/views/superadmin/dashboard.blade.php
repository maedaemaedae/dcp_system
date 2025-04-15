<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white leading-tight">
            Super Admin Dashboard
        </h2>
    </x-slot>

    <div class="py-12 px-6">
        <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
            <p class="text-gray-800 dark:text-white text-lg">Welcome, {{ $user->name }}</p>
            <p class="text-sm text-gray-500 mt-2">You are logged in as <strong>Super Admin</strong>.</p>
        </div>
    </div>
</x-app-layout>
