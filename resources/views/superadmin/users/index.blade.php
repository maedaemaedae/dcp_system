<!DOCTYPE html>
<html lang="en" x-data="{ open: true }">
<head>
    <meta charset="UTF-8">
    <title>Manage Users</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <script src="https://unpkg.com/alpinejs" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">


<style>
    @keyframes fade-in-up {
        0% { opacity: 0; transform: translateY(20px); }
        100% { opacity: 1; transform: translateY(0); }
    }

    @keyframes fade-out-down {
        0% { opacity: 1; transform: translateY(0); }
        100% { opacity: 0; transform: translateY(20px); }
    }

    .fade-in {
        animation: fade-in-up 0.4s ease-out forwards;
    }

    .fade-out {
        animation: fade-out-down 0.4s ease-in forwards;
    }
</style>


<script>
    function fadeOutAlert(id) {
        const alertBox = document.getElementById(id);
        if (alertBox) {
            alertBox.classList.remove('fade-in');
            alertBox.classList.add('fade-out');
            setTimeout(() => alertBox.remove(), 400);
        }
    }

    window.addEventListener('DOMContentLoaded', () => {
        ['alert-success', 'alert-error'].forEach(id => {
            const el = document.getElementById(id);
            if (el) {
                setTimeout(() => fadeOutAlert(id), 4000);
            }
        });
    });
</script>

</head>
          @php
            $authUser = auth()->user();
            $isSuperAdmin = $authUser && $authUser->role_id === 1;
            $isAdmin = $authUser && $authUser->role && $authUser->role->role_name === 'admin';
        @endphp

<body class="bg-white font-['Poppins']" x-data="{ open: true }">
    <div class="flex h-screen">

         
            @include('layouts.sidebar') 
       

        <div class="fixed top-0 left-[300px] right-0 bg-white shadow-md h-20 z-10 transition-all duration-300" :class="open ? 'left-[300px]' : 'left-20'">
            @include('layouts.top-navbar') 
            <div class="flex items-center justify-between h-full px-8">
                
        </div>

        <main  :class="open ? 'ml-[5px]' : 'ml-5'" class="transition-all duration-300 p-8 relative flex-1 overflow-y-auto h-screen"
>
    <div class="max-w-6xl mx-auto">
       <h2 class="text-[42px] font-bold text-gray-800 dark:text-white mb-6 border-b border-gray-300 dark:border-gray-600 pb-2 tracking-wide flex items-center gap-4">
            <i class="fa-solid fa-users text-blue-500 text-4xl w-10 h-10"></i>
            Manage Users
        </h2>


<!-- Toast Alert -->
@if (session('success'))
    <div id="alert-success"
        class="fixed bottom-6 left-1/2 transform -translate-x-1/2 fade-in bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg text-sm font-medium z-50 flex items-center space-x-2">
        <span class="text-lg">✔</span>
        <span>{{ session('success') }}</span>
        <button onclick="fadeOutAlert('alert-success')" class="ml-3 text-white hover:text-gray-200 font-bold">
            &times;
        </button>
    </div>
@endif

@if (session('error'))
    <div id="alert-error"
        class="fixed bottom-6 left-1/2 transform -translate-x-1/2 fade-in bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg text-sm font-medium z-50 flex items-center space-x-2">
        <span class="text-lg">⚠️</span>
        <span>{{ session('error') }}</span>
        <button onclick="fadeOutAlert('alert-error')" class="ml-3 text-white hover:text-gray-200 font-bold">
            &times;
        </button>
    </div>
@endif

            <!-- Search Bar -->
            <form method="GET" action="{{ route('superadmin.users') }}" class="mb-4">
                <div class="flex items-center space-x-2">
                    <div class="relative w-1/3">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name, email, or role"
                            class="w-full px-4 py-2 border border-gray-300 rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 placeholder-gray-400 pl-10">
                            
                        <!-- Search Icon -->
                        <i class="fa fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-500"></i>
                    </div>
                    <button type="submit" class="bg-[#4A90E2] hover:bg-[#357ABD] text-white px-6 py-2 rounded-full transition-colors duration-200">
                        Search
                    </button>
                </div>
            </form>



            <!-- User Management Table -->
            <div class="overflow-x-auto bg-white rounded-2xl shadow border mb-40">
                <table class="min-w-full text-sm divide-y divide-gray-200">
                    <thead class="bg-[#4A90E2] text-white">
            <tr>
                <th class="px-6 py-3 text-left font-semibold">Name</th>
                <th class="px-6 py-3 text-left font-semibold">Email</th>
                <th class="px-6 py-3 text-left font-semibold">Current Role</th>
                <th class="px-6 py-3 text-center font-semibold">Change Role</th>
            </tr>
        </thead>
     <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-100 dark:divide-gray-700">
    @foreach ($users as $user)

                @php
                $roleName = optional($user->role)->role_name;
                $roleClass = match($roleName) {
                    'Super Admin' => 'background-color: #FECACA; color: #B91C1C;',
                    'Admin' => 'background-color: #DBEAFE; color: #1D4ED8;',
                    'Regional Office Representative' => 'background-color: #FDEDED; color: #7F1D1D;', // Soft pinkish bg, deep maroon text
                    'Division Office Representative' => 'background-color: #EDE9FE; color: #6D28D9;',
                    'School Representative' => 'background-color: #D1FAE5; color: #065F46;',
                    'Supplier' => 'background-color: #FEF9C3; color: #92400E;', // Soft yellow bg, warm brown text
                    default => 'background-color: #F3F4F6; color: #6B7280;', // gray fallback
                };
            @endphp

        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
            <td class="px-6 py-4 text-gray-800 dark:text-gray-100">{{ $user->name }}</td>
            <td class="px-6 py-4 text-gray-600 dark:text-gray-300">{{ $user->email }}</td>
            <td class="px-4 py-5 text-gray-700 dark:text-gray-200"> 
                <span class="inline-block px-2 py-0.5 rounded-full text-s font-semibold" style="{{ $roleClass }}">
                    {{ $roleName ?? '—' }}
                </span>
            </td>
            <td class="px-6 py-4">
                @if ($authUser->id !== $user->id)
                    <form method="POST" action="{{ route('superadmin.users.updateRole', $user->id) }}" class="flex items-center space-x-2 border-[#033372]">
                        @csrf
                        <select name="role_id" class="bg-white dark:bg-gray-700 dark:border-gray-600 dark:text-white rounded-lg border border-gray-300 px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#4A90E2] hover:border-[#4A90E2] transition-all duration-300 shadow-sm hover:shadow-md">
                            <option value="1" {{ $user->role_id == 1 ? 'selected' : '' }}>Super Admin</option>
                            <option value="2" {{ $user->role_id == 2 ? 'selected' : '' }}>Admin</option>
                            <option value="3" {{ $user->role_id == 3 ? 'selected' : '' }}>Regional Rep</option>
                            <option value="4" {{ $user->role_id == 4 ? 'selected' : '' }}>Division Rep</option>
                            <option value="5" {{ $user->role_id == 5 ? 'selected' : '' }}>School Rep</option>
                            <option value="6" {{ $user->role_id == 6 ? 'selected' : '' }}>Supplier</option>
                        </select>

                        <button type="submit" class="bg-[#4A90E2] hover:bg-[#357ABD] text-white px-6 py-3 rounded-full text-sm font-semibold shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-[#4A90E2] transition-all duration-300 transform hover:scale-105">
                            Update
                        </button>
                    </form>
                @else
                    <span class="text-gray-400 text-sm italic transition-colors duration-300 hover:text-[#4A90E2] flex justify-center items-center w-full">
                        You
                    </span>
                @endif
            </td>
        </tr>
    @endforeach
</tbody>


              </table>
           </div>
           
            <div class="h-12"></div>

</main>
        </div>
    
    </body>
</html>
