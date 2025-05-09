{{-- resources/views/regionaloffices/index.blade.php --}}
<!DOCTYPE html>
<html lang="en" x-data="{ open: true }">
<head>
    <meta charset="UTF-8">
    <title>Regional Offices</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
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

        {{-- Main Content --}}
        <main :class="open ? 'ml-72' : 'ml-20'" class="transition-all duration-300 pt-24 p-8 relative">
        <h2 class="text-[45px] font-bold text-gray-800 dark:text-white mb-6 border-b border-gray-300 dark:border-gray-600 pb-2 tracking-wide">
            🗺️ Regional Offices
            </h2>


            @if (session('success'))
                <div class="mb-4 text-green-600 font-medium">{{ session('success') }}</div>
            @endif

            <!-- Add Regional Office Button -->
            <button id="openAddModalBtn" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mb-4">
                + Add Regional Office
            </button>

         <!-- Regional Offices Table -->
<div class="overflow-x-auto bg-white dark:bg-gray-900 p-4 rounded-lg shadow-md border border-gray-200 dark:border-gray-700">
    <table class="min-w-full text-sm divide-y divide-gray-200 dark:divide-gray-700">
        <thead class="bg-blue-600 text-white">
            <tr>
                <th class="px-6 py-3 text-left font-semibold">Office</th>
                <th class="px-6 py-3 text-left font-semibold">In Charge</th>
                <th class="px-6 py-3 text-left font-semibold">Email</th>
                <th class="px-6 py-3 text-left font-semibold">Contact No.</th>
                <th class="px-6 py-3 text-left font-semibold">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-100 dark:divide-gray-700">
            @forelse ($regionalOffices as $ro)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                    <td class="px-6 py-4 text-gray-900 dark:text-gray-100">{{ $ro->ro_office }}</td>
                    <td class="px-6 py-4 text-gray-700 dark:text-gray-200">{{ $ro->person_in_charge }}</td>
                    <td class="px-6 py-4 text-gray-700 dark:text-gray-300">{{ $ro->email }}</td>
                    <td class="px-6 py-4 text-gray-700 dark:text-gray-300">{{ $ro->contact_no }}</td>
                    <td class="px-6 py-4 space-x-2 whitespace-nowrap">
                        <button onclick="openEditModal({{ $ro->ro_id }})"
                            class="inline-flex items-center px-3 py-1 bg-blue-500 hover:bg-blue-600 text-white text-xs font-medium rounded-md transition">
                            ✏️ Edit
                        </button>
                        <form action="{{ route('regional-offices.destroy', $ro->ro_id) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Are you sure?')"
                                class="inline-flex items-center px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white text-xs font-medium rounded-md transition">
                                🗑️ Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @include('regionaloffices.edit', ['ro' => $ro])
            @empty
                <tr>
                    <td colspan="5" class="text-center text-gray-500 dark:text-gray-400 py-6">
                        No regional offices found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>


        
  <!-- Include the Create Modal -->
  @include('regionaloffices.create')
               


<script>
    document.getElementById('openAddModalBtn')?.addEventListener('click', () => {
        const modal = document.getElementById('addModal');
        modal?.classList.remove('hidden');
        modal?.classList.add('flex');
    });

    document.getElementById('closeAddModalBtn')?.addEventListener('click', () => {
        const modal = document.getElementById('addModal');
        modal?.classList.add('hidden');
        modal?.classList.remove('flex');
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

@if (session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const toast = document.createElement('div');
            let message = "{{ session('success') }}";
            if (message.includes('Added')) {
                message = '✔' + message;
            } else if (message.includes('Updated')) {
                message = '✏️' + message;
            } else if (message.includes('Removed')) {
                message = '🗑' + message;
            }

            toast.innerText = message;
            toast.className = "fixed bottom-4 left-1/2 transform -translate-x-1/2 bg-green-500 text-white py-4 px-8 rounded-lg shadow-lg z-50 text-center text-lg font-semibold";
            document.body.appendChild(toast);

            setTimeout(() => {
                toast.remove();
            }, 3000);
        });
    </script>
@endif

</body>
</html>
