<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <title>Packages</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">


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

<body class="bg-gray-100 font-sans">
<div class="flex h-screen relative bg-white">

     <!-- Side Bar -->
     @include('layouts.sidebar')

    <!-- Top Nav Bar -->
    @include('layouts.top-navbar')

    
      <!-- Main Content -->
<div :class="open ? 'ml-[300px]' : 'ml-20'" class="transition-all duration-300 pt-24 p-8 relative">
    <h2 class="text-[45px] font-bold text-gray-800 mb-6 border-b border-gray-300 pb-2 tracking-wide">
        📦 Package Type
    </h2>

    <!-- Add Package Button -->
    <div class="mb-6">
        <button id="openAddModalBtn" 
        class="bg-[#4A90E2] hover:bg-[#357ABD] text-white font-medium px-6 py-2.5 rounded-full shadow-md hover:shadow-lg transition-all duration-300 ease-in-out mb-4 flex items-center space-x-2">
                <i class="fas fa-plus"></i>
                <span>Add Package</span>
            </button>
     </div>

<!-- Packages List Wrapper -->
<div class="flex justify-center">
    <!-- Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6 place-items-stretch">
        @foreach ($packages as $package)
        <!-- Package Card -->
        <div class="bg-white p-6 shadow-lg rounded-xl border border-gray-100 transition-all duration-300 ease-in-out hover:shadow-2xl hover:border-[#4A90E2] flex flex-col justify-between min-h-[260px]">
            <div class="flex justify-between items-start mb-4">
                <div class="flex-1">
                    <!-- Card Content -->
                    <h3 class="text-xl font-semibold text-gray-800">{{ $package->package_code }}</h3>
                    <p class="text-gray-600 text-sm mt-1">{{ $package->description }}</p>
                </div>
                <div class="flex items-start gap-2 ml-4">
                    <!-- Edit Button -->
                    <button 
                        onclick="openEditModal({{ $package->id }})"
                        class="px-4 py-1.5 rounded-full bg-[#4A90E2] text-white hover:bg-[#357ABD] transition duration-200 ease-in-out shadow-md text-sm font-medium"
                        title="Edit">
                        Edit
                    </button>

                    <!-- Delete Button -->
                    <form method="POST" action="{{ route('package-types.destroy', $package->id) }}" onsubmit="return confirm('Are you sure you want to delete this package?')">
                        @csrf
                        @method('DELETE')
                        <button 
                            type="submit"
                            class="px-4 py-1.5 rounded-full border border-red-500 text-red-500 hover:bg-red-500 hover:text-white transition duration-200 ease-in-out text-sm font-medium shadow-md">
                            Delete
                        </button>
                    </form>
                </div>
            </div>

            <!-- Package Contents -->
            <div class="text-sm text-gray-700 mt-auto">
                <p class="font-semibold mb-2">Contents:</p>
                <ul class="space-y-1 list-disc list-inside">
                    @forelse ($package->contents as $content)
                        <li>
                            <span class="font-medium text-gray-800">{{ $content->inventory->item_name }}</span>
                            <span class="text-gray-500">– Qty: {{ $content->quantity }}</span>
                        </li>
                    @empty
                        <li class="text-gray-400 italic">No contents listed</li>
                    @endforelse
                </ul>
            </div>
        </div>

        @include('packages.partials.edit-modal', ['packageType' => $package, 'inventoryItems' => $inventoryItems])
        @endforeach
    </div>
</div>



<!-- Pagination Links -->
<div class="mt-10">
    {{ $packages->links('vendor.pagination.tailwind') }}
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
