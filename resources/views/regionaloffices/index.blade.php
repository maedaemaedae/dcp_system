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
    document.addEventListener('DOMContentLoaded', function () {
        let message = @json(session('success')).trim();

        const toast = document.createElement('div');

        // Defaults
        let icon = '✅';
        let bgColor = 'bg-green-500';

        // Match by keyword (case-insensitive)
        if (/added/i.test(message)) {
            icon = '✅';
            bgColor = 'bg-green-500';
        } else if (/updated/i.test(message)) {
            icon = '✏️';
            bgColor = 'bg-blue-500';
        } else if (/removed|deleted/i.test(message)) {
            icon = '🗑️';
            bgColor = 'bg-red-500';
        }

        // Toast content
        toast.innerHTML = `
            <div class="flex items-center justify-between space-x-4">
                <div class="flex items-center space-x-3">
                    <span class="text-xl">${icon}</span>
                    <span>${message}</span>
                </div>
                <button onclick="this.parentElement.parentElement.remove()" class="text-white text-xl hover:text-gray-200 transition">&times;</button>
            </div>
        `;

        toast.className = `
            fixed bottom-6 left-1/2 transform -translate-x-1/2
            ${bgColor} text-white px-6 py-3 rounded-xl shadow-lg
            text-sm font-medium z-50 min-w-[300px] max-w-md
            animate-fade-in-up
        `;

        document.body.appendChild(toast);

        // Auto-remove after 4s
        setTimeout(() => {
            toast.classList.remove("animate-fade-in-up");
            toast.classList.add("animate-fade-out-down");
            setTimeout(() => toast.remove(), 400);
        }, 4000);
    });
</script>



<style>
@keyframes fade-in-up {
    0% { opacity: 0; transform: translateY(20px); }
    100% { opacity: 1; transform: translateY(0); }
}
@keyframes fade-out-down {
    0% { opacity: 1; transform: translateY(0); }
    100% { opacity: 0; transform: translateY(20px); }
}
.animate-fade-in-up {
    animation: fade-in-up 0.4s ease-out forwards;
}
.animate-fade-out-down {
    animation: fade-out-down 0.4s ease-in forwards;
}
</style>

@endif

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
        @include('components.top-navbar')
    

        {{-- Main Content --}}
        <main :class="open ? 'ml-72' : 'ml-20'" class="transition-all duration-300 pt-24 p-8 relative">
        <h2 class="text-[45px] font-bold text-gray-800 dark:text-white mb-6 border-b border-gray-300 dark:border-gray-600 pb-2 tracking-wide">
            🗺️ Regional Offices
            </h2>


            @if (session('success'))
                <div class="mb-4 text-green-600 font-medium">{{ session('success') }}</div>
            @endif

            <!-- Add Regional Office Button -->
           <button id="openAddModalBtn"
                class="bg-[#4A90E2] hover:bg-[#357ABD] text-white font-medium px-6 py-2.5 rounded-full shadow-md hover:shadow-lg transition-all duration-300 ease-in-out mb-4 flex items-center space-x-2">
                <i class="fas fa-plus"></i>
                <span>Add Regional Office</span>
            </button>

        <!-- Regional Offices Table -->
            <div class="overflow-x-auto bg-white rounded-2xl shadow-md border border-gray-200">
                <table class="min-w-full text-sm divide-y divide-gray-200">
                    <thead class="bg-[#4A90E2] text-white">
            <tr>
                <th class="px-6 py-3 text-left font-semibold">Office</th>
                <th class="px-6 py-3 text-left font-semibold">In Charge</th>
                <th class="px-6 py-3 text-left font-semibold">Email</th>
                <th class="px-6 py-3 text-left font-semibold">Contact No.</th>
                <th class="px-6 py-3 text-center font-semibold">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-100">
            @forelse ($regionalOffices as $ro)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4 text-gray-800 font-medium">{{ $ro->ro_office }}</td>
                    <td class="px-6 py-4 text-gray-700">{{ $ro->person_in_charge }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $ro->email }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $ro->contact_no }}</td>
                    <td class="px-6 py-4 text-center whitespace-nowrap">
                        <div class="flex justify-center gap-2">
                            <!-- Edit Button -->
                            <button onclick="openEditModal({{ $ro->ro_id }})"
                                class="px-4 py-1.5 rounded-full bg-[#4A90E2] text-white hover:bg-[#357ABD] transition shadow-sm text-sm font-medium">
                                Edit
                            </button>

                            <!-- Delete Button -->
                            <form action="{{ route('regional-offices.destroy', $ro->ro_id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Are you sure?')"
                                    class="px-4 py-1.5 rounded-full border border-red-500 text-red-500 hover:bg-red-500 hover:text-white transition shadow-sm text-sm font-medium">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @include('regionaloffices.edit', ['ro' => $ro])
            @empty
                <tr>
                    <td colspan="5" class="text-center text-gray-500 py-6 italic">
                        No regional offices found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>


        
  <!-- Include the Create Modal -->
  @include('regionaloffices.create')

</body>
</html>
