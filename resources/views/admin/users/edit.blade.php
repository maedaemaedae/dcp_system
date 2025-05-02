<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white">
            Edit User
        </h2>
    </x-slot>

    <div class="p-6 max-w-xl mx-auto">
        <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
            @csrf

            @if (session('success'))
                <div class="mb-4 text-green-600 font-medium">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="mb-4 text-red-600 font-medium">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Name:</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                       class="w-full px-3 py-2 border rounded shadow-sm focus:ring focus:ring-indigo-200">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Email:</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                       class="w-full px-3 py-2 border rounded shadow-sm focus:ring focus:ring-indigo-200">
            </div>

            <div class="flex items-center space-x-3">
                <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">Save</button>
                <a href="{{ route('admin.users') }}" class="text-gray-600 hover:underline">Cancel</a>
            </div>
        </form>
    </div>
</x-app-layout>
