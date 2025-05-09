<!DOCTYPE html>
<html lang="en" x-data="{ open: true }">
<head>
    <meta charset="UTF-8">
    <title>Manage Users</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <script src="https://unpkg.com/alpinejs" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-white font-['Poppins']" x-data="{ open: true }">
<div class="flex h-screen">

    <div class="w-[1440px] h-[1024px] relative bg-white overflow-hidden">

        {{-- Sidebar --}}
        @php
            $authUser = auth()->user();
            $isSuperAdmin = $authUser && $authUser->role_id === 1;
            $isAdmin = $authUser && $authUser->role && $authUser->role->role_name === 'admin';
        @endphp

       <!-- Side Bar -->
       @include('components.sidebar')

        <!-- Top Nav Bar -->
        <header class="w-full h-20 fixed top-0 left-0 bg-white shadow-md flex items-center justify-between px-8 z-10">
            <div class="flex items-center gap-2">
                <img src="{{ asset('images/landscape-logo.png') }}" class="h-20 w-auto ml-[-20px]" alt="Logo">
            </div>

            <div class="relative" x-data="{ open: false }">
                <div class="flex items-center gap-4">
                    <span class="text-base text-black">{{ $authUser->name }}</span>
                    <button @click="open = !open" class="w-14 h-14 bg-zinc-300 rounded-full flex items-center justify-center hover:ring-2 hover:ring-blue-500 transition focus:outline-none mr-[40px]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M5.121 17.804A13.937 13.937 0 0112 15c2.485 0 4.779.63 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </button>
                </div>

                <div x-show="open" @click.away="open = false"
                     class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-2 z-20 text-sm text-gray-700"
                     x-transition>
                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 hover:bg-gray-100">Profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-100">Logout</button>
                    </form>
                </div>
            </div>
        </header>

       <!-- Main content -->
        <main :class="open ? 'ml-72' : 'ml-20'" class="transition-all duration-300 pt-24 p-8 relative">
        <h2 class="text-[45px] font-bold text-gray-800 dark:text-white mb-6 border-b border-gray-300 dark:border-gray-600 pb-2 tracking-wide">
            👥 Manage Users
            </h2>


            @if (session('success'))
                <div class="mb-4 text-green-600 font-medium">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="mb-4 text-red-600 font-medium">{{ session('error') }}</div>
            @endif

            <form method="GET" action="{{ route('superadmin.users') }}" class="mb-4">
                <div class="flex items-center space-x-2">
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Search by name, email, or role"
                           class="px-3 py-2 border rounded w-1/3">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Search</button>
                </div>
            </form>

            <!-- User Management Table -->
            <div class="overflow-x-auto bg-white dark:bg-gray-900 p-4 rounded-lg shadow-lg">
    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 border border-gray-200 dark:border-gray-700 rounded-md overflow-hidden text-sm">
        <thead class="bg-blue-600 text-white uppercase tracking-wide text-xs">
            <tr>
                <th class="px-6 py-3 text-left font-semibold">Name</th>
                <th class="px-6 py-3 text-left font-semibold">Email</th>
                <th class="px-6 py-3 text-left font-semibold">Current Role</th>
                <th class="px-6 py-3 text-left font-semibold">Change Role</th>
            </tr>
        </thead>
        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-100 dark:divide-gray-700">
            @foreach ($users as $user)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                    <td class="px-6 py-4 text-gray-800 dark:text-gray-100">{{ $user->name }}</td>
                    <td class="px-6 py-4 text-gray-600 dark:text-gray-300">{{ $user->email }}</td>
                    <td class="px-6 py-4 text-gray-700 dark:text-gray-200">
                        {{ $user->role->role_name ?? '—' }}
                    </td>
                    <td class="px-6 py-4">
                        @if ($authUser->id !== $user->id)
                            <form method="POST" action="{{ route('superadmin.users.updateRole', $user->id) }}" class="flex items-center space-x-2 border-[#033372]">
                                @csrf
                                <select name="role_id" class="rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white px-2 py-1 text-sm">
                                    <option value="1" {{ $user->role_id == 1 ? 'selected' : '' }}>Super Admin</option>
                                    <option value="2" {{ $user->role_id == 2 ? 'selected' : '' }}>Admin</option>
                                    <option value="3" {{ $user->role_id == 3 ? 'selected' : '' }}>Regional Rep</option>
                                    <option value="4" {{ $user->role_id == 4 ? 'selected' : '' }}>Division Rep</option>
                                    <option value="5" {{ $user->role_id == 5 ? 'selected' : '' }}>School Rep</option>
                                    <option value="6" {{ $user->role_id == 6 ? 'selected' : '' }}>Supplier</option>
                                </select>
                                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded-md text-sm transition">
                                    Update
                                </button>
                            </form>
                        @else
                            <span class="text-gray-400 text-sm italic pl-10">You</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

</div>
</body>
</html>
