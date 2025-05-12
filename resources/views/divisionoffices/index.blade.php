<!DOCTYPE html>
<html lang="en" x-data="{ open: true }">
<head>
    <meta charset="UTF-8">
    <title>Division Offices</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-white font-['Poppins']" x-data="{ open: true }">
<div class="flex h-screen">

    <div class="w-[1440px] h-[1024px] relative bg-white overflow-hidden">
        <!-- Sidebar -->
        @php
            $authUser = auth()->user();
            $isSuperAdmin = $authUser && $authUser->role_id === 1;
            $isAdmin = $authUser && $authUser->role && $authUser->role->role_name === 'admin';
        @endphp

    <!-- Side Bar -->
    @include('components.sidebar')

    <!-- Top Nav Bar -->
    @include('components.top-navbar')
       

        <!-- Main Content -->
        <main :class="open ? 'ml-[300px]' : 'ml-20'" class="transition-all duration-300 pt-24 p-8 relative">
    <h2 class="text-[42px] font-bold text-gray-800 dark:text-white mb-6 border-b border-gray-300 dark:border-gray-600 pb-2 tracking-wide">
        🏢 Division Offices
    </h2>

    @if (session('success'))
        <div class="mb-4 text-green-600 font-medium bg-green-100 border border-green-200 rounded px-4 py-2">
            {{ session('success') }}
        </div>
    @endif

    <!-- Add Division Office Button -->
    <button id="openAddModalBtn" 
     class="bg-[#4A90E2] hover:bg-[#357ABD] text-white font-medium px-6 py-2.5 rounded-full shadow-md hover:shadow-lg transition-all duration-300 ease-in-out mb-4 flex items-center space-x-2">
                <i class="fas fa-plus"></i>
                <span>Add Division Office</span>
            </button>

    <!-- Division Offices Table -->
    <div class="overflow-x-auto bg-white rounded-2xl shadow-md border border-gray-200">
        <table class="min-w-full text-sm divide-y divide-gray-200">
            <thead class="bg-[#4A90E2] text-white">
                <tr>
                    <th class="px-6 py-3 text-left font-semibold">Division Name</th>
                    <th class="px-6 py-3 text-left font-semibold">Person in Charge</th>
                    <th class="px-6 py-3 text-left font-semibold">Region</th>
                    <th class="px-6 py-3 text-left font-semibold">Email</th>
                    <th class="px-6 py-3 text-left font-semibold">Contact No.</th>
                    <th class="px-6 py-3 text-center font-semibold">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @forelse ($divisions as $division)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 text-gray-800 font-medium">{{ $division->division_name }}</td>
                        <td class="px-6 py-4 text-gray-700">{{ $division->person_in_charge }}</td>
                        <td class="px-6 py-4 text-gray-700">{{ $division->regionalOffice->ro_office ?? '—' }}</td>
                        <td class="px-6 py-4 text-gray-600">{{ $division->email }}</td>
                        <td class="px-6 py-4 text-gray-600">{{ $division->contact_no }}</td>
                        <td class="px-6 py-4 text-center whitespace-nowrap">

                            <div class="flex items-center space-x-2">
                                <!-- Edit Button -->
                                <a href="{{ route('division-offices.edit', $division->division_id) }}"
                                   class="px-4 py-1.5 rounded-full bg-[#4A90E2] text-white hover:bg-[#357ABD] transition shadow-sm text-sm font-medium"
                                    title="Edit"
                                   >
                                   Edit
                                </a>

                                <!-- Delete Button -->
                                <form action="{{ route('division-offices.destroy', $division->division_id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Are you sure?')"
                                        class="px-4 py-1.5 rounded-full border border-red-500 text-red-500 hover:bg-red-500 hover:text-white transition text-sm font-medium shadow-sm">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-gray-500 py-6 italic">
                            No divisions found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</main>


        <script>
            // Open the Add Modal
            document.getElementById('openAddModalBtn')?.addEventListener('click', () => {
                const modal = document.getElementById('addModal');
                modal?.classList.remove('hidden');
                modal?.classList.add('flex');
            });

            // Close the Add Modal
            document.getElementById('closeAddModalBtn')?.addEventListener('click', () => {
                const modal = document.getElementById('addModal');
                modal?.classList.add('hidden');
                modal?.classList.remove('flex');
            });

            // Get the modal element
    const editModal = document.getElementById('editModal');
    // Get the button that opens the modal
    const openEditModalBtn = document.getElementById('openEditModalBtn');
    // Get the button that closes the modal
    const closeEditModalBtn = document.getElementById('closeEditModalBtn');

    // Open the modal when the user clicks the "Edit Division Office" button
    openEditModalBtn.addEventListener('click', () => {
        editModal.classList.remove('hidden');
    });

    // Close the modal when the user clicks the "Cancel" button
    closeEditModalBtn.addEventListener('click', () => {
        editModal.classList.add('hidden');
    });

    // Close the modal when the user clicks outside the modal area
    window.addEventListener('click', (e) => {
        if (e.target === editModal) {
            editModal.classList.add('hidden');
        }
    });
        </script>
        
        @if (session('success'))
       <script>
    document.addEventListener('DOMContentLoaded', () => {
        let message = "{{ session('success') }}";
        if (!message) return;

        const toast = document.createElement('div');
        let icon = '✅';
        let bgColor = 'bg-green-500';

        if (message.includes('Added')) {
            icon = '✅';
            bgColor = 'bg-green-500';
        } else if (message.includes('Updated')) {
            icon = '✏️';
            bgColor = 'bg-blue-500';
        } else if (message.includes('Removed') || message.includes('Deleted')) {
            icon = '🗑️';
            bgColor = 'bg-red-500';
        }

        toast.innerHTML = `
            <div class="flex justify-between items-center space-x-4">
                <div class="flex items-center gap-3">
                    <span class="text-xl">${icon}</span>
                    <span class="text-base">${message}</span>
                </div>
                <button onclick="this.parentElement.parentElement.remove()" class="text-white text-xl hover:text-gray-200">&times;</button>
            </div>
        `;

        toast.className = `
            fixed bottom-6 left-1/2 transform -translate-x-1/2
            ${bgColor} text-white px-6 py-3 rounded-xl shadow-lg
            text-sm font-medium z-50 min-w-[280px] max-w-md
            animate-fade-in-up
        `;

        document.body.appendChild(toast);

        setTimeout(() => {
            toast.classList.remove("animate-fade-in-up");
            toast.classList.add("animate-fade-out-down");
            setTimeout(() => toast.remove(), 500);
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

</body>
</html>

