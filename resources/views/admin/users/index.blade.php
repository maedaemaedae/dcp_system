<x-app-layout>
    <x-slot name="header">
        @if (session('success'))
            <div class="mb-4 text-green-600 font-medium">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="mb-4 text-red-600 font-medium">{{ session('error') }}</div>
        @endif

        <h2 class="text-xl font-semibold text-gray-800 dark:text-white">Manage Users</h2>
    </x-slot>

    <div class="p-6">
        <form method="GET" action="{{ route('admin.users') }}" class="mb-4">
            <div class="flex items-center space-x-2">
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Search by name or email"
                       class="px-3 py-2 border rounded w-1/3">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Search</button>
            </div>
        </form>

        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead>
                <tr>
                    <th class="px-4 py-2 text-left">Name</th>
                    <th class="px-4 py-2 text-left">Email</th>
                    <th class="px-4 py-2 text-left">Role</th>
                    <th class="px-4 py-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @foreach ($users as $user)
                    <tr>
                        <td class="px-4 py-2">{{ $user->name }}</td>
                        <td class="px-4 py-2">{{ $user->email }}</td>
                        <td class="px-4 py-2">{{ $user->role->role_name ?? 'No Role' }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('admin.users.edit', $user->id) }}"
                               class="text-blue-600 hover:underline">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
