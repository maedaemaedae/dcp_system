<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <script src="https://unpkg.com/alpinejs" defer></script>

    <!-- Google Fonts: Poppins -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

</head>

<body class="bg-white font-['Poppins']" x-data="{ open: true }">
  <div class="flex h-screen">

    <div class="w-[1440px] h-[1024px] relative bg-white overflow-hidden">
        
      <!-- Side Bar -->
    @include('components.sidebar')

       <!-- Top Navbar -->
<header class="w-full h-20 fixed top-0 left-0 bg-white shadow-md flex items-center justify-between px-8 z-10">
    <div class="flex items-center gap-2">
        <img src="{{ asset('images/landscape-logo.png') }}" class="h-20 w-auto ml-[-20px]" alt="Logo">
    </div>

    <div class="relative" x-data="{ open: false }">
        <!-- User Name -->
        <div class="flex items-center gap-4">
            <span class="text-base text-black">{{ Auth::user()->name }}</span>

            <!-- Profile Dropdown Trigger -->
            <button @click="open = !open" class="w-14 h-14 bg-zinc-300 rounded-full flex items-center justify-center hover:ring-2 hover:ring-blue-500 transition focus:outline-none mr-[40px]">
                <!-- Optional icon or profile initials -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 15c2.485 0 4.779.63 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </button>
        </div>

        <!-- Dropdown Menu -->
        <div x-show="open" @click.away="open = false"
             class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-2 z-20 text-sm text-gray-700 "
             x-transition>
            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 hover:bg-gray-100">Profile</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-100">Logout</button>
            </form>
        </div>
    </div>
</header>




        <!-- Sample Dashboard Content Area -->
            <main :class="open ? 'ml-72' : 'ml-20'" class="transition-all duration-300 top-24 p-8 relative">

            <h2 class="text-[45px] font-bold text-gray-800 dark:text-white mb-6 border-b border-gray-300 dark:border-gray-600 pb-2 tracking-wide">
                📊 Dashboard
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-white dark:bg-gray-800 shadow-lg rounded-2xl p-20 h-52 flex items-center justify-center">
                    <span class="text-gray-700 dark:text-white font-semibold">Card 1</span>
                </div>
                <div class="bg-white dark:bg-gray-800 shadow-lg rounded-2xl p-20 h-52 flex items-center justify-center">
                    <span class="text-gray-700 dark:text-white font-semibold">Card 2</span>
                </div>
                <div class="bg-white dark:bg-gray-800 shadow-lg rounded-2xl p-20 h-52 flex items-center justify-center">
                    <span class="text-gray-700 dark:text-white font-semibold">Card 3</span>
                </div>
            </div>
            </main>

    </div>
</body>
</html>
