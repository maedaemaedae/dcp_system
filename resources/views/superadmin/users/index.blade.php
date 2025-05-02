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
        <form method="GET" action="{{ route('superadmin.users') }}" class="mb-4">
            <div class="flex items-center space-x-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name, email, or role"
                    class="px-3 py-2 border rounded w-1/3">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Search</button>
            </div>
        </form>

        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead>
                <tr>
                    <th class="px-4 py-2 text-left">Name</th>
                    <th class="px-4 py-2 text-left">Email</th>
                    <th class="px-4 py-2 text-left">Current Role</th>
                    <th class="px-4 py-2 text-left">Change Role</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @foreach ($users as $user)
                    <tr>
                        <td class="px-4 py-2">{{ $user->name }}</td>
                        <td class="px-4 py-2">{{ $user->email }}</td>
                        <td class="px-4 py-2">{{ $user->role->role_name ?? '—' }}</td>
                        <td class="px-4 py-2">
                            @if (auth()->id() !== $user->id)
                                <form method="POST" action="{{ route('superadmin.users.updateRole', $user->id) }}">
                                    @csrf
                                    <select name="role_id" class="border rounded px-2 py-1">
                                        <option value="1" {{ $user->role_id == 1 ? 'selected' : '' }}>Super Admin</option>
                                        <option value="2" {{ $user->role_id == 2 ? 'selected' : '' }}>Admin</option>
                                        <option value="3" {{ $user->role_id == 3 ? 'selected' : '' }}>Regional Rep</option>
                                        <option value="4" {{ $user->role_id == 4 ? 'selected' : '' }}>Division Rep</option>
                                        <option value="5" {{ $user->role_id == 5 ? 'selected' : '' }}>School Rep</option>
                                        <option value="6" {{ $user->role_id == 6 ? 'selected' : '' }}>Supplier</option>
                                    </select>
                                    <button type="submit" class="ml-2 bg-blue-600 text-white px-3 py-1 rounded">Update</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
