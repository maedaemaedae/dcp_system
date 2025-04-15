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
                                <select name="role_name" class="border rounded px-2 py-1">
                                    <option value="super_admin" {{ $user->role->role_name === 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                                    <option value="admin" {{ $user->role->role_name === 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="regional" {{ $user->role->role_name === 'regional' ? 'selected' : '' }}>Regional Rep</option>
                                    <option value="division" {{ $user->role->role_name === 'division' ? 'selected' : '' }}>Division Rep</option>
                                    <option value="school" {{ $user->role->role_name === 'school' ? 'selected' : '' }}>School Rep</option>
                                    <option value="supplier" {{ $user->role->role_name === 'supplier' ? 'selected' : '' }}>Supplier</option>
                                </select>
                                <button type="submit" class="ml-2 bg-blue-600 text-white px-2 py-1 rounded text-sm">Update</button>
                            </form>
                        @else
                            <span class="text-sm text-gray-500 italic">You</span>
                        @endif
                    </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
