<!DOCTYPE html>
<html lang="en">
<head>
    <title>ICT Equipment | DCP Tracking Hub</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="icon" href="{{ asset('images/final-portrait-logo.png') }}" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<style>
    @keyframes fadeInUp {
        0% {
            opacity: 0;
            transform: translateY(40px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }
    @keyframes fadeOutDown {
        0% {
            opacity: 1;
            transform: translateY(0);
        }
        100% {
            opacity: 0;
            transform: translateY(40px);
        }
    }
    .animate-fadeInUp {
        animation: fadeInUp 0.35s cubic-bezier(.4,0,.2,1) both;
    }
    .animate-fadeOutDown {
        animation: fadeOutDown 0.25s cubic-bezier(.4,0,.2,1) both;
    }

    [x-cloak] { display: none !important; }

</style>
<body class="bg-gray-50 font-['Poppins'] text-gray-800" x-data="{ contentVisible: false }" x-init="setTimeout(() => contentVisible = true, 100)">

<div class="min-h-screen relative">
    @include('layouts.top-navbar')

    <div class="relative px-6 py-8 max-w-8xl mx-auto" x-show="contentVisible" x-transition.opacity.duration.500ms x-cloak>
        
         <!-- Back to Inventory Button -->
        <a href="{{ route('inventory.index') }}"
           class="absolute top-[6.5rem] left-6 text-[#4A90E2] hover:text-[#357ABD] text-base font-medium flex items-center transition-all duration-300 ease-in-out transform hover:-translate-x-1 bg-white dark:bg-gray-800 px-4 py-2 rounded-full shadow-md">
            <!-- Left Arrow Icon -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 transition-transform duration-300 group-hover:-translate-x-1" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            Back to Inventory
        </a>

        <!-- Page Title -->
        <h1 class="text-3xl md:text-4xl font-bold mt-48 mb-16 flex items-center gap-3">
            ICT Equipment
        </h1>

        <!-- Import & Export Section -->
        <div class="bg-white shadow-md rounded-xl p-6 mb-8 border border-gray-100 flex flex-wrap gap-4 items-center justify-between">
            <form method="POST" action="{{ route('ict-equipment.import') }}" enctype="multipart/form-data" class="flex flex-wrap items-center gap-3">
                @csrf
                <label for="ict_csv" 
                       class="flex items-center gap-2 px-4 py-2 border border-[#2D9CDB] text-[#2D9CDB] rounded-lg hover:bg-[#2D9CDB] hover:text-white cursor-pointer transition">
                    <i class="fa-solid fa-paperclip"></i> Import CSV
                </label>
                <input id="ict_csv" type="file" name="csv_file" accept=".csv" required class="hidden"/>
                <p id="ict-file-name" class="text-sm text-gray-600">No file selected</p>
                <button type="submit" 
                        class="px-5 py-2 bg-[#2D9CDB] hover:bg-[#2384ba] text-white rounded-lg shadow transition">
                    <i class="fa-solid fa-upload"></i> Upload
                </button>
            </form>
            <a href="{{ route('ict-equipment.export') }}" 
               class="px-5 py-2 bg-[#2D9CDB] hover:bg-[#2384ba] text-white rounded-lg shadow transition flex items-center gap-2">
                <i class="fa-solid fa-file-export"></i> Export CSV
            </a>
        </div>

        @if (session('success'))
    <div 
        x-data="{ show: true }" 
        x-init="setTimeout(() => show = false, 5000)" 
        x-show="show" 
        x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="opacity-0 -translate-y-4 scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
        x-transition:leave="transition ease-in duration-200 transform"
        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
        x-transition:leave-end="opacity-0 -translate-y-4 scale-95"
        class="fixed top-[90px] left-1/2 transform -translate-x-1/2 z-50 
               bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg 
               text-sm flex items-center gap-2"
    >
        <i class="fa-solid fa-circle-check"></i>
        {{ session('success') }}
    </div>
@endif

        <!-- Add New Equipment -->
        <div class="flex justify-start mb-10">
            <button id="openModalBtn" 
                    class="px-5 py-2 bg-[#2D9CDB] hover:bg-[#2384ba] text-white rounded-lg shadow flex items-center gap-2 transition">
                <i class="fa-solid fa-plus"></i> Add New Equipment
            </button>
        </div>

        <!-- Add Modal -->
<div id="equipmentModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center">
    <div id="equipmentModalContent" class="bg-white rounded-2xl shadow-2xl w-full max-w-4xl max-h-[90vh] flex flex-col relative mx-4">
        <!-- Header -->
        <div class="sticky top-0 z-10 flex justify-between items-center px-6 py-4 border-b bg-white rounded-t-2xl">
            <h2 class="text-2xl font-bold text-gray-800">Add New ICT Equipment</h2>
            <button id="closeModalBtn" class="text-gray-400 hover:text-gray-600 transition text-xl">
                ✕
            </button>
        </div>

        <!-- Body (Scrollable if needed) -->
        <form action="{{ route('ict-equipment.store') }}" method="POST" class="overflow-y-auto px-6 py-6 space-y-6">
            @csrf

            <!-- Equipment Identification -->
            <div class="p-4 bg-gray-50 rounded-xl shadow-sm">
                <h3 class="font-semibold text-gray-700 mb-3">🔑 Equipment Identification</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input type="text" name="equipment_id" placeholder="Equipment ID" class="border rounded-lg p-2 w-full" required>
                    <input type="text" name="item_description" placeholder="Description" class="border rounded-lg p-2 w-full" required>
                    <input type="text" name="category" placeholder="Category" class="border rounded-lg p-2 w-full" required>
                    <input type="text" name="brand" placeholder="Brand" class="border rounded-lg p-2 w-full" required>
                    <input type="text" name="model" placeholder="Model" class="border rounded-lg p-2 w-full md:col-span-2" required>
                </div>
            </div>

            <!-- Asset Details -->
            <div class="p-4 bg-gray-50 rounded-xl shadow-sm">
                <h3 class="font-semibold text-gray-700 mb-3">📦 Asset Details</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input type="text" name="asset_number" placeholder="Asset #" class="border rounded-lg p-2 w-full" required>
                    <input type="text" name="serial_number" placeholder="Serial #" class="border rounded-lg p-2 w-full" required>
                </div>
            </div>

            <!-- Assignment & Location -->
            <div class="p-4 bg-gray-50 rounded-xl shadow-sm">
                <h3 class="font-semibold text-gray-700 mb-3">📍 Assignment & Location</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input type="text" name="location" placeholder="Location" class="border rounded-lg p-2 w-full" required>
                    <input type="text" name="assigned_to" placeholder="Assigned To" class="border rounded-lg p-2 w-full" required>
                </div>
            </div>

            <!-- Purchase & Warranty -->
            <div class="p-4 bg-gray-50 rounded-xl shadow-sm">
                <h3 class="font-semibold text-gray-700 mb-3">🧾 Purchase & Warranty</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input type="date" name="purchase_date" class="border rounded-lg p-2 w-full" required>
                    <input type="date" name="warranty_expiry" class="border rounded-lg p-2 w-full" required>
                </div>
            </div>

            <!-- Status -->
            <div class="p-4 bg-gray-50 rounded-xl shadow-sm">
                <h3 class="font-semibold text-gray-700 mb-3">📊 Status</h3>
                <select name="condition" class="border rounded-lg p-2 w-full" required>
                    <option value="IN USE">IN USE</option>
                    <option value="FOR REPAIR">FOR REPAIR</option>
                </select>
            </div>

            <!-- Notes -->
            <div class="p-4 bg-gray-50 rounded-xl shadow-sm">
                <h3 class="font-semibold text-gray-700 mb-3">📝 Notes (Optional)</h3>
                <textarea name="note" placeholder="Additional notes..." class="border rounded-lg p-2 w-full h-20 resize-none"></textarea>
            </div>

            <!-- Actions -->
            <div class="flex justify-end items-center gap-3 pt-4 border-t">
                <button type="button" id="cancelModalBtn" 
                    class="px-5 py-2.5 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-lg transition">
                    Cancel
                </button>
                <button type="submit" 
                    class="px-6 py-2.5 bg-[#2D9CDB] hover:bg-[#2384ba] text-white font-semibold rounded-lg shadow-md transition">
                    Save
                </button>
            </div>
        </form>
    </div>
</div>

        <!-- Edit Equipment Modal -->
<div id="editEquipmentModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center">
    <div id="editEquipmentModalContent" class="bg-white rounded-2xl shadow-2xl w-full max-w-4xl max-h-[90vh] flex flex-col relative mx-4">
        <!-- Header -->
        <div class="sticky top-0 z-10 flex justify-between items-center px-6 py-4 border-b bg-white rounded-t-2xl">
            <h2 class="text-2xl font-bold text-gray-800">Edit ICT Equipment</h2>
            <button id="closeEditModalBtn" class="text-gray-400 hover:text-gray-600 transition text-xl">
                ✕
            </button>
        </div>
        <!-- Body (Scrollable if needed) -->
        <form id="editEquipmentForm" method="POST" class="overflow-y-auto px-6 py-6 space-y-6">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" id="edit_id">
            <div class="p-4 bg-gray-50 rounded-xl shadow-sm">
                <h3 class="font-semibold text-gray-700 mb-3">🔑 Equipment Identification</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input type="text" name="equipment_id" id="edit_equipment_id" placeholder="Equipment ID" class="border rounded-lg p-2 w-full" required>
                    <input type="text" name="item_description" id="edit_item_description" placeholder="Description" class="border rounded-lg p-2 w-full" required>
                    <input type="text" name="category" id="edit_category" placeholder="Category" class="border rounded-lg p-2 w-full" required>
                    <input type="text" name="brand" id="edit_brand" placeholder="Brand" class="border rounded-lg p-2 w-full" required>
                    <input type="text" name="model" id="edit_model" placeholder="Model" class="border rounded-lg p-2 w-full md:col-span-2" required>
                </div>
            </div>
            <div class="p-4 bg-gray-50 rounded-xl shadow-sm">
                <h3 class="font-semibold text-gray-700 mb-3">📦 Asset Details</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input type="text" name="asset_number" id="edit_asset_number" placeholder="Asset #" class="border rounded-lg p-2 w-full" required>
                    <input type="text" name="serial_number" id="edit_serial_number" placeholder="Serial #" class="border rounded-lg p-2 w-full" required>
                </div>
            </div>
            <div class="p-4 bg-gray-50 rounded-xl shadow-sm">
                <h3 class="font-semibold text-gray-700 mb-3">📍 Assignment & Location</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input type="text" name="location" id="edit_location" placeholder="Location" class="border rounded-lg p-2 w-full" required>
                    <input type="text" name="assigned_to" id="edit_assigned_to" placeholder="Assigned To" class="border rounded-lg p-2 w-full" required>
                </div>
            </div>
            <div class="p-4 bg-gray-50 rounded-xl shadow-sm">
                <h3 class="font-semibold text-gray-700 mb-3">🧾 Purchase & Warranty</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input type="date" name="purchase_date" id="edit_purchase_date" class="border rounded-lg p-2 w-full" required>
                    <input type="date" name="warranty_expiry" id="edit_warranty_expiry" class="border rounded-lg p-2 w-full" required>
                </div>
            </div>
            <div class="p-4 bg-gray-50 rounded-xl shadow-sm">
                <h3 class="font-semibold text-gray-700 mb-3">📊 Status</h3>
                <select name="condition" id="edit_condition" class="border rounded-lg p-2 w-full" required>
                    <option value="IN USE">IN USE</option>
                    <option value="FOR REPAIR">FOR REPAIR</option>
                </select>
            </div>
            <div class="p-4 bg-gray-50 rounded-xl shadow-sm">
                <h3 class="font-semibold text-gray-700 mb-3">📝 Notes (Optional)</h3>
                <textarea name="note" id="edit_note" placeholder="Additional notes..." class="border rounded-lg p-2 w-full h-20"></textarea>
            </div>
            <div class="flex justify-end items-center gap-3 pt-4 border-t">
                <button type="button" id="cancelEditModalBtn" 
                    class="px-5 py-2.5 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-lg transition">
                    Cancel
                </button>
                <button type="submit" 
                    class="px-6 py-2.5 bg-[#2D9CDB] hover:bg-[#2384ba] text-white font-semibold rounded-lg shadow-md transition">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>

        <!-- Delete Equipment Modal -->
<div id="deleteEquipmentModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center">
    <div id="deleteEquipmentModalContent" class="bg-white rounded-2xl shadow-2xl w-full max-w-md flex flex-col relative mx-4">
        <div class="flex justify-between items-center px-6 py-4 border-b bg-white rounded-t-2xl">
            <h2 class="text-xl font-bold text-gray-800">Delete Equipment</h2>
            <button type="button" id="closeDeleteModalBtn" class="text-gray-400 hover:text-gray-600 transition text-xl">
                ✕
            </button>
        </div>
        <form id="deleteEquipmentForm" method="POST" class="px-6 py-6 space-y-6">
            @csrf
            @method('DELETE')
            <input type="hidden" name="id" id="delete_id">
            <p class="text-gray-700 text-center text-lg">Are you sure you want to delete this equipment?</p>
            <div class="flex justify-end items-center gap-3 pt-4 border-t">
                <button type="button" id="cancelDeleteModalBtn"
                    class="px-5 py-2.5 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-lg transition">
                    Cancel
                </button>
                <button type="submit"
                    class="px-6 py-2.5 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg shadow-md transition">
                    Delete
                </button>
            </div>
        </form>
    </div>
</div>

        <!-- Wrapper -->
    <div x-data="{
        search: '',
        matches(row) {
            return this.search === '' || row.toLowerCase().includes(this.search.toLowerCase());
        }
    }" class="space-y-4">

        <!-- Search bar -->
        <div>
            <label for="search" class="block font-medium text-sm mb-2 text-gray-700">Search Equipment</label>
            <div class="relative w-[50%] mb-10">
                <!-- Search icon -->
                <i class="fa fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-500"></i>

                <!-- Input -->
                <input type="text" id="search" x-model="search"
                       placeholder="Equipment ID, Description, Category, etc."
                       class="w-full px-4 py-2 border border-gray-300 rounded-full shadow-sm 
                              focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 
                              placeholder-gray-400 pl-10">

                <!-- Clear button -->
                <button type="button" x-show="search" @click="search = ''"
                        class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600"
                        title="Clear search">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Table -->
        <div class="bg-white shadow-md rounded-xl overflow-y-hidden overflow-x border border-gray-200">
                <table class="min-w-full text-sm divide-y divide-gray-200">
                    <thead class="bg-[#4A90E2] text-white sticky top-0">
                    <tr>
                        <th class="p-3 text-left whitespace-nowrap">Equipment ID</th>
                        <th class="p-3 text-left">Description</th>
                        <th class="p-2 text-center">Category</th>
                        <th class="p-3 text-center">Brand</th>
                        <th class="p-3 text-center">Model</th>
                        <th class="p-3 text-center whitespace-nowrap">Asset #</th>
                        <th class="p-3 text-center whitespace-nowrap">Serial #</th>
                        <th class="p-3 text-center">Location</th>
                        <th class="p-3 text-center whitespace-nowrap">Assigned To</th>
                        <th class="p-3 text-center whitespace-nowrap">Purchase Date</th>
                        <th class="p-3 text-center whitespace-nowrap">Warranty Expiry</th>
                        <th class="p-3 text-center">Condition</th>
                        <th class="p-3 text-center">Note</th>
                        <th class="p-3 text-center sticky right-0 bg-[#4A90E2] z-10">Action</th>
                    </tr>
                    </thead>
                    <tbody id="equipment-table" class="divide-y divide-gray-100">
                        @forelse ($equipments as $equip)
                            <tr class="hover:bg-gray-50 transition" data-id="{{ $equip->id }}"
                            x-show="matches(`{{ strtolower(
                                $equip->equipment_id . ' ' .
                                $equip->item_description . ' ' .
                                $equip->category . ' ' .
                                $equip->brand . ' ' .
                                $equip->model . ' ' .
                                $equip->asset_number . ' ' .
                                $equip->serial_number . ' ' .
                                $equip->location . ' ' .
                                $equip->assigned_to . ' ' .
                                $equip->purchase_date->format('Y-m-d') . ' ' .
                                $equip->warranty_expiry->format('Y-m-d') . ' ' .
                                $equip->condition . ' ' .
                                ($equip->note ?? '')
                            ) }}`)">
                                <td class="p-2 text-left">{{ $equip->equipment_id }}</td>
                                <td class="p-2 text-left">{{ $equip->item_description }}</td>
                                <td class="p-2 text-center">{{ $equip->category }}</td>
                                <td class="p-2 text-center">{{ $equip->brand }}</td>
                                <td class="p-2 text-center">{{ $equip->model }}</td>
                                <td class="p-2 text-center">{{ $equip->asset_number }}</td>
                                <td class="p-2 text-center">{{ $equip->serial_number }}</td>
                                <td class="p-2 text-center">{{ $equip->location }}</td>
                                <td class="p-2 text-center">{{ $equip->assigned_to }}</td>
                                <td class="p-2 text-center">{{ $equip->purchase_date->format('Y-m-d') }}</td>
                                <td class="p-2 text-center">{{ $equip->warranty_expiry->format('Y-m-d') }}</td>
                                <td class="p-2 text-center">
                                    @if($equip->condition === 'IN USE')
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700 border border-green-200 whitespace-nowrap">
                                            <i class="fa-solid fa-circle-check text-green-600"></i> IN USE
                                        </span>
                                    @elseif($equip->condition === 'FOR REPAIR')
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-700 border border-yellow-200 whitespace-nowrap">
                                            <i class="fa-solid fa-screwdriver-wrench text-yellow-600"></i> FOR REPAIR
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-600 border border-gray-200 whitespace-nowrap">
                                            <i class="fa-solid fa-circle-question text-gray-500"></i> {{ $equip->condition }}
                                        </span>
                                    @endif
                                </td>
                                <td class="p-2 text-center whitespace-pre-wrap">{{ $equip->note ?? '—' }}</td>
                                <td class="p-2 text-center flex gap-3 justify-center sticky right-0 bg-white">
                                    <button type="button"
                            class="edit-btn group relative text-blue-600 hover:text-white transition rounded-full focus:outline-none focus:ring-2 focus:ring-blue-300"
                            title="Edit">
                            <span class="sr-only">Edit</span>
                            <span class="flex items-center justify-center w-9 h-9 rounded-full bg-blue-50 group-hover:bg-blue-600 transition">
                                <i class="fa-solid fa-pen group-hover:scale-110 transition-transform"></i>
                            </span>
                            <span class="absolute left-1/2 -translate-x-1/2 top-12 bg-gray-800 text-white text-xs rounded px-2 py-1 opacity-0 group-hover:opacity-100 pointer-events-none transition-opacity z-10">
                                Edit
                            </span>
                        </button>
                        <button type="button"
                            class="delete-btn group relative text-red-600 hover:text-white transition rounded-full focus:outline-none focus:ring-2 focus:ring-red-300"
                            title="Delete">
                            <span class="sr-only">Delete</span>
                            <span class="flex items-center justify-center w-9 h-9 rounded-full bg-red-50 group-hover:bg-red-600 transition">
                                <i class="fa-solid fa-trash group-hover:scale-110 transition-transform"></i>
                            </span>
                            <span class="absolute left-1/2 -translate-x-1/2 top-12 bg-gray-800 text-white text-xs rounded px-2 py-1 opacity-0 group-hover:opacity-100 pointer-events-none transition-opacity z-10">
                                Delete
                            </span>
                        </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="14" class="p-6 text-center text-gray-500">No ICT equipment found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-8">
                    {{ $equipments->links('vendor.pagination.tailwind') }}
            </div>
        </div>

    </div>
</div>



<script>
    // Show selected file name
    const ictInput = document.getElementById('ict_csv');
    const ictFileName = document.getElementById('ict-file-name');
    ictInput.addEventListener('change', () => {
        const file = ictInput.files[0];
        ictFileName.textContent = file ? file.name : 'No file selected';
    });

    // Modal toggle for Add Modal with animation
    const modal = document.getElementById('equipmentModal');
    const modalContent = document.getElementById('equipmentModalContent');
    const openBtn = document.getElementById('openModalBtn');
    const closeBtn = document.getElementById('closeModalBtn');
    const cancelBtn = document.getElementById('cancelModalBtn');
    function showAddModal() {
        modal.classList.remove('hidden');
        modalContent.classList.remove('animate-fadeOutDown');
        modalContent.classList.add('animate-fadeInUp');
    }
    function hideAddModal() {
        modalContent.classList.remove('animate-fadeInUp');
        modalContent.classList.add('animate-fadeOutDown');
        setTimeout(() => { modal.classList.add('hidden'); }, 250);
    }
    if (openBtn) openBtn.addEventListener('click', showAddModal);
    if (closeBtn) closeBtn.addEventListener('click', hideAddModal);
    if (cancelBtn) cancelBtn.addEventListener('click', hideAddModal);

    // Modal toggle for Edit Modal with animation
    const editModal = document.getElementById('editEquipmentModal');
    const editModalContent = document.getElementById('editEquipmentModalContent');
    const closeEditBtn = document.getElementById('closeEditModalBtn');
    const cancelEditBtn = document.getElementById('cancelEditModalBtn');
    function showEditModal() {
        editModal.classList.remove('hidden');
        editModalContent.classList.remove('animate-fadeOutDown');
        editModalContent.classList.add('animate-fadeInUp');
    }
    function hideEditModal() {
        editModalContent.classList.remove('animate-fadeInUp');
        editModalContent.classList.add('animate-fadeOutDown');
        setTimeout(() => { editModal.classList.add('hidden'); }, 250);
    }
    [closeEditBtn, cancelEditBtn].forEach(btn => {
        if (btn) btn.addEventListener('click', hideEditModal);
    });

    // Open edit modal and populate fields
    document.querySelectorAll('.edit-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const row = btn.closest('tr');
            const tds = row.querySelectorAll('td');
            document.getElementById('edit_id').value = row.getAttribute('data-id');
            document.getElementById('edit_equipment_id').value = tds[0].textContent.trim();
            document.getElementById('edit_item_description').value = tds[1].textContent.trim();
            document.getElementById('edit_category').value = tds[2].textContent.trim();
            document.getElementById('edit_brand').value = tds[3].textContent.trim();
            document.getElementById('edit_model').value = tds[4].textContent.trim();
            document.getElementById('edit_asset_number').value = tds[5].textContent.trim();
            document.getElementById('edit_serial_number').value = tds[6].textContent.trim();
            document.getElementById('edit_location').value = tds[7].textContent.trim();
            document.getElementById('edit_assigned_to').value = tds[8].textContent.trim();
            document.getElementById('edit_purchase_date').value = tds[9].textContent.trim();
            document.getElementById('edit_warranty_expiry').value = tds[10].textContent.trim();
            document.getElementById('edit_condition').value = tds[11].innerText.trim();
            document.getElementById('edit_note').value = tds[12].textContent.trim() === '—' ? '' : tds[12].textContent.trim();
            showEditModal();
            document.getElementById('editEquipmentForm').setAttribute('action', `/ict-equipment/${row.getAttribute('data-id')}`);
        });
    });

    // Submit edit form using standard form POST (let Laravel handle the update)
    document.getElementById('editEquipmentForm').addEventListener('submit', function(e) {
        // Remove e.preventDefault(); to allow normal form submission
    });

    // Delete Modal logic
    const deleteModal = document.getElementById('deleteEquipmentModal');
    const deleteModalContent = document.getElementById('deleteEquipmentModalContent');
    const closeDeleteBtn = document.getElementById('closeDeleteModalBtn');
    const cancelDeleteBtn = document.getElementById('cancelDeleteModalBtn');
    function showDeleteModal() {
        deleteModal.classList.remove('hidden');
        deleteModalContent.classList.remove('animate-fadeOutDown');
        deleteModalContent.classList.add('animate-fadeInUp');
    }
    function hideDeleteModal() {
        deleteModalContent.classList.remove('animate-fadeInUp');
        deleteModalContent.classList.add('animate-fadeOutDown');
        setTimeout(() => { deleteModal.classList.add('hidden'); }, 250);
    }
    // Fix: Use event listeners after DOM is loaded
    document.addEventListener('DOMContentLoaded', function() {
        if (closeDeleteBtn) closeDeleteBtn.addEventListener('click', hideDeleteModal);
        if (cancelDeleteBtn) cancelDeleteBtn.addEventListener('click', hideDeleteModal);

        // Open delete modal and set form action
        document.querySelectorAll('.delete-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const row = btn.closest('tr');
                const id = row.getAttribute('data-id');
                document.getElementById('delete_id').value = id;
                document.getElementById('deleteEquipmentForm').setAttribute('action', `/ict-equipment/${id}`);
                showDeleteModal();
            });
        });
    });

    // Alpine.js data and methods for search functionality
    document.addEventListener('alpine:init', () => {
        Alpine.data('equipmentTable', () => ({
            search: '',
            get filteredEquipments() {
                if (!this.search) return @json($equipments);
                const searchTerm = this.search.toLowerCase();
                return @json($equipments).filter(equip => {
                    return Object.values(equip).some(
                        value => String(value).toLowerCase().includes(searchTerm)
                    );
                });
            }
        }));
    });
</script>

</body>
</html>
