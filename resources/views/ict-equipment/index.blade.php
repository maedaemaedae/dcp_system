<!DOCTYPE html>
<html lang="en">
<head>
    <title>ICT Equipment | DCP Tracking Hub</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="icon" href="{{ asset('images/final-portrait-logo.png') }}" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
        <div class="bg-white shadow-md rounded-xl p-6 mb-8 border border-gray-100 flex flex-wrap gap-4 items-center justify-between hidden">
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



        @if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

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

        <!-- Category Selection Buttons -->
        <div class="flex flex-wrap gap-4 mb-6">
            <button id="laptopBtn" class="category-btn px-6 py-3 bg-gray-200 text-gray-700 rounded-lg shadow-md hover:bg-gray-300 transition-all duration-300 flex items-center gap-2 font-medium">
                <i class="fa-solid fa-laptop"></i> Laptops
            </button>
            <button id="printerBtn" class="category-btn px-6 py-3 bg-gray-200 text-gray-700 rounded-lg shadow-md hover:bg-gray-300 transition-all duration-300 flex items-center gap-2 font-medium">
                <i class="fa-solid fa-print"></i> Printers
            </button>
            <button id="desktopBtn" class="category-btn px-6 py-3 bg-gray-200 text-gray-700 rounded-lg shadow-md hover:bg-gray-300 transition-all duration-300 flex items-center gap-2 font-medium">
                <i class="fa-solid fa-desktop"></i> Desktops
            </button>
        </div>

        <!-- Add New Equipment -->
        <div class="flex justify-start mb-10">
            <button id="openModalBtn" 
                    class="px-5 py-2 bg-[#2D9CDB] hover:bg-[#2384ba] text-white rounded-lg shadow flex items-center gap-2 transition">
                <i class="fa-solid fa-plus"></i> Add New Equipment
            </button>
        </div>

    <div class="mb-4 flex gap-2">
        <form method="POST" action="{{ route('ict-equipment.import.category', ['category' => 'laptop']) }}" enctype="multipart/form-data" class="flex items-center gap-2">
            @csrf
            <label for="import-laptop-csv" class="btn btn-secondary cursor-pointer px-3 py-2 bg-green-100 text-green-800 rounded hover:bg-green-200 flex items-center gap-2">
                <i class="fa-solid fa-file-import"></i> Import Laptops
            </label>
            <input id="import-laptop-csv" type="file" name="csv_file" accept=".csv" required class="hidden" onchange="this.form.submit()"/>
        </form>
        <a href="{{ route('ict-equipment.export', ['category' => 'laptop']) }}" 
           class="btn btn-primary">
            Export Laptops
        </a>
        <form method="POST" action="{{ route('ict-equipment.import.category', ['category' => 'printer']) }}" enctype="multipart/form-data" class="flex items-center gap-2">
            @csrf
            <label for="import-printer-csv" class="btn btn-secondary cursor-pointer px-3 py-2 bg-green-100 text-green-800 rounded hover:bg-green-200 flex items-center gap-2">
                <i class="fa-solid fa-file-import"></i> Import Printers
            </label>
            <input id="import-printer-csv" type="file" name="csv_file" accept=".csv" required class="hidden" onchange="this.form.submit()"/>
        </form>
        <a href="{{ route('ict-equipment.export', ['category' => 'printer']) }}" 
           class="btn btn-primary">
            Export Printers
        </a>
        <form method="POST" action="{{ route('ict-equipment.import.category', ['category' => 'desktop']) }}" enctype="multipart/form-data" class="flex items-center gap-2">
            @csrf
            <label for="import-desktop-csv" class="btn btn-secondary cursor-pointer px-3 py-2 bg-green-100 text-green-800 rounded hover:bg-green-200 flex items-center gap-2">
                <i class="fa-solid fa-file-import"></i> Import Desktops
            </label>
            <input id="import-desktop-csv" type="file" name="csv_file" accept=".csv" required class="hidden" onchange="this.form.submit()"/>
        </form>
        <a href="{{ route('ict-equipment.export', ['category' => 'desktop']) }}" 
           class="btn btn-primary">
            Export Desktops
        </a>
    </div>


        <!-- Add Modal -->
<div id="equipmentModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center">
    <div id="equipmentModalContent" class="bg-white rounded-2xl shadow-2xl w-full max-w-4xl max-h-[90vh] flex flex-col relative mx-4x">
        <!-- Header -->
        <div class="sticky top-0 z-10 flex justify-between items-center px-6 py-4 border-b bg-white rounded-t-2xl">
            <h2 class="text-2xl font-bold text-gray-800">Add New ICT Equipment</h2>
            <button id="closeModalBtn" class="text-gray-400 hover:text-gray-600 transition text-xl">
                ✕
            </button>
        </div>

        <!-- Body (Scrollable if needed) -->
        <div class="overflow-y-auto px-6 py-6 space-y-6">
            <!-- Category Selection -->
            <div class="p-4 bg-blue-50 rounded-xl shadow-sm border border-blue-200">
                <h3 class="font-semibold text-gray-700 mb-3 flex items-center gap-2">
                    <i class="fa-solid fa-list text-blue-500"></i> Select Equipment Category
                </h3>
                <div class="flex flex-wrap gap-3">
                    <button type="button" id="selectLaptop" class="category-select-btn px-4 py-2 bg-white border-2 border-gray-300 text-gray-700 rounded-lg hover:border-blue-500 hover:text-blue-600 transition-all duration-300 flex items-center gap-2">
                        <i class="fa-solid fa-laptop"></i> Laptop
                    </button>
                    <button type="button" id="selectPrinter" class="category-select-btn px-4 py-2 bg-white border-2 border-gray-300 text-gray-700 rounded-lg hover:border-blue-500 hover:text-blue-600 transition-all duration-300 flex items-center gap-2">
                        <i class="fa-solid fa-print"></i> Printer
                    </button>
                    <button type="button" id="selectDesktop" class="category-select-btn px-4 py-2 bg-white border-2 border-gray-300 text-gray-700 rounded-lg hover:border-blue-500 hover:text-blue-600 transition-all duration-300 flex items-center gap-2">
                        <i class="fa-solid fa-desktop"></i> Desktop
                    </button>
                </div>
                <p class="text-sm text-gray-600 mt-2">Please select a category to show the appropriate form fields.</p>
            </div>

            <!-- Dynamic Form Container -->
            <div id="dynamicFormContainer">
                <div class="text-center py-12 text-gray-500">
                    <i class="fa-solid fa-arrow-up text-4xl mb-4"></i>
                    <p class="text-lg">Select a category above to start adding equipment</p>
                </div>
            </div>
        </div>
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
                    <select name="category" id="edit_category" class="border rounded-lg p-2 w-full" required>
                        <option value="">Select Category</option>
                        <option value="laptop">Laptop</option>
                        <option value="printer">Printer</option>
                        <option value="desktop">Desktop</option>
                    </select>
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

        

        <!-- Laptop Table -->
        <div id="laptopTable" class="table-container hidden">
            @include('ict-equipment.partials.laptop-table')
        </div>

        <!-- Printer Table -->
        <div id="printerTable" class="table-container hidden">
            @include('ict-equipment.partials.printer-table')
        </div>

        <!-- Desktop Table -->
        <div id="desktopTable" class="table-container hidden">
            @include('ict-equipment.partials.desktop-table')
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

    // Category switching functionality
    document.addEventListener('DOMContentLoaded', function() {
        const categoryButtons = document.querySelectorAll('.category-btn');
        const tableContainers = document.querySelectorAll('.table-container');

        function showTable(tableId) {
            // Hide all tables
            tableContainers.forEach(container => {
                container.classList.add('hidden');
            });
            
            // Show selected table
            const selectedTable = document.getElementById(tableId);
            if (selectedTable) {
                selectedTable.classList.remove('hidden');
            }
        }

        function updateButtonStyles(activeButtonId) {
            // Reset all buttons to inactive style
            categoryButtons.forEach(btn => {
                btn.classList.remove('bg-[#2D9CDB]', 'text-white');
                btn.classList.add('bg-gray-200', 'text-gray-700');
            });
            
            // Set active button style
            const activeButton = document.getElementById(activeButtonId);
            if (activeButton) {
                activeButton.classList.remove('bg-gray-200', 'text-gray-700');
                activeButton.classList.add('bg-[#2D9CDB]', 'text-white');
            }
        }

        // Add click event listeners to category buttons
        categoryButtons.forEach(button => {
            button.addEventListener('click', function() {
                const buttonId = this.id;
                let tableId = '';
                
                switch(buttonId) {
                    case 'allBtn':
                        tableId = 'allTable';
                        break;
                    case 'laptopBtn':
                        tableId = 'laptopTable';
                        break;
                    case 'printerBtn':
                        tableId = 'printerTable';
                        break;
                    case 'desktopBtn':
                        tableId = 'desktopTable';
                        break;
                }
                
                if (tableId) {
                    showTable(tableId);
                    updateButtonStyles(buttonId);
                }
            });
        });

        // Initialize with "All Equipment" view
        updateButtonStyles('allBtn');
    });

    // Dynamic form switching for add modal
    document.addEventListener('DOMContentLoaded', function() {
        const selectLaptop = document.getElementById('selectLaptop');
        const selectPrinter = document.getElementById('selectPrinter');
        const selectDesktop = document.getElementById('selectDesktop');
        const dynamicFormContainer = document.getElementById('dynamicFormContainer');
        const categorySelectBtns = document.querySelectorAll('.category-select-btn');

        function updateCategoryButtonStyles(activeButton) {
            // Reset all category selection buttons
            categorySelectBtns.forEach(btn => {
                btn.classList.remove('border-blue-500', 'text-blue-600', 'bg-blue-50');
                btn.classList.add('border-gray-300', 'text-gray-700', 'bg-white');
            });
            
            // Set active button style
            if (activeButton) {
                activeButton.classList.remove('border-gray-300', 'text-gray-700', 'bg-white');
                activeButton.classList.add('border-blue-500', 'text-blue-600', 'bg-blue-50');
            }
        }

        function loadFormPartial(partialName) {
            console.log('Loading form partial:', partialName);
            
            // Get CSRF token
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            
            fetch(`/ict-equipment/partials/${partialName}`, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'text/html',
                }
            })
                .then(response => {
                    console.log('Response status:', response.status);
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.text();
                })
                .then(html => {
                    console.log('Form HTML loaded successfully, length:', html.length);
                    dynamicFormContainer.innerHTML = html;
                    // Re-attach event listeners for the new form
                    attachFormEventListeners();
                })
                .catch(error => {
                    console.error('Error loading form partial:', error);
                    dynamicFormContainer.innerHTML = `
                        <div class="text-center py-12 text-red-500">
                            <i class="fa-solid fa-exclamation-triangle text-4xl mb-4"></i>
                            <p class="text-lg">Error loading form. Please try again.</p>
                            <p class="text-sm mt-2">Error: ${error.message}</p>
                        </div>
                    `;
                });
        }

        function attachFormEventListeners() {
            // Re-attach cancel button event listener
            const cancelBtn = document.getElementById('cancelModalBtn');
            if (cancelBtn) {
                cancelBtn.addEventListener('click', hideAddModal);
            }
            
            // Add form submission debugging
            const form = document.querySelector('#dynamicFormContainer form');
            if (form) {
                form.addEventListener('submit', function(e) {
                    console.log('Form being submitted:', this);
                    console.log('Form data:', new FormData(this));
                });
            }
        }

        if (selectLaptop) {
            selectLaptop.addEventListener('click', function() {
                updateCategoryButtonStyles(this);
                loadFormPartial('create-laptop-fields');
            });
        }

        if (selectPrinter) {
            selectPrinter.addEventListener('click', function() {
                updateCategoryButtonStyles(this);
                loadFormPartial('create-printer-fields');
            });
        }

        if (selectDesktop) {
            selectDesktop.addEventListener('click', function() {
                updateCategoryButtonStyles(this);
                loadFormPartial('create-desktop-fields');
            });
        }
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

<script>
document.addEventListener("DOMContentLoaded", () => {
    // Open modal
    document.querySelectorAll("[data-modal-open]").forEach(button => {
        button.addEventListener("click", () => {
            const modalId = button.getAttribute("data-modal-open");
            document.getElementById(modalId).classList.remove("hidden");
            document.getElementById(modalId).classList.add("flex");
        });
    });

    // Close modal
    document.querySelectorAll("[data-modal-close]").forEach(button => {
        button.addEventListener("click", () => {
            const modalId = button.getAttribute("data-modal-close");
            document.getElementById(modalId).classList.add("hidden");
            document.getElementById(modalId).classList.remove("flex");
        });
    });
});
</script>


</body>
</html>