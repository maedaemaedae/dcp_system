<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <title>Packages</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-gray-100 font-sans">
<div class="flex h-screen relative bg-white">

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

      <!-- Main Content -->
<div :class="open ? 'ml-[300px]' : 'ml-20'" class="transition-all duration-300 pt-24 p-8 relative">
    <h2 class="text-[45px] font-bold text-gray-800 mb-6 border-b border-gray-300 pb-2 tracking-wide">
        📦 Package Type
    </h2>

    <!-- Add Package Button -->
    <div class="mb-6">
        <button id="openAddModalBtn" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded transition">
            + Add Package
        </button>
    </div>

    <!-- Package List -->
    @foreach ($packages as $package)
        <div class="bg-white p-4 shadow rounded mb-4">
            <div class="flex justify-between items-center">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">{{ $package->package_code }}</h3>
                    <p class="text-gray-600">{{ $package->description }}</p>
                </div>
                <div class="flex gap-2">
                    <button onclick="openEditModal({{ $package->id }})" class="text-blue-600 hover:underline">
                        Edit
                    </button>
                    <form method="POST" action="{{ route('package-types.destroy', $package->id) }}"
                          onsubmit="return confirm('Are you sure you want to delete this package?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
            <ul class="mt-2 text-sm text-gray-700">
                @foreach ($package->contents as $content)
                    <li>
                        {{ $content->inventory->item_name }} – Qty: {{ $content->quantity }}
                    </li>
                @endforeach
            </ul>
        </div>

        @include('packages.partials.edit-modal', ['packageType' => $package, 'inventoryItems' => $inventoryItems])
    @endforeach
</div>

<!-- Create Modal -->
@include('packages.partials.create-modal', ['inventoryItems' => $inventoryItems])


    <script>
        const addModal = document.getElementById('addModal');
        const openAddBtn = document.getElementById('openAddModalBtn');
        const closeAddBtn = document.getElementById('closeAddModalBtn');

        openAddBtn.addEventListener('click', () => {
            addModal.classList.remove('hidden');
            addModal.classList.add('flex');
        });

        closeAddBtn.addEventListener('click', () => {
            addModal.classList.add('hidden');
            addModal.classList.remove('flex');
        });

        function openEditModal(id) {
            const modal = document.getElementById(`editModal-${id}`);
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeEditModal(id) {
            const modal = document.getElementById(`editModal-${id}`);
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    </script>

        </body>
</html>
