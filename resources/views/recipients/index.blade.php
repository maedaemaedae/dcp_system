<!DOCTYPE html>
<html lang="en" x-data="{ open: true }">
<head>
    <meta charset="UTF-8">
    <title>Recipients</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

</head>

<style>
    @keyframes fadeInUp {
    0% {
        opacity: 0;
        transform: translateY(20px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fadeInUp {
    animation: fadeInUp 0.4s ease-out both;
}

</style>


<body class="bg-white font-['Poppins']" x-data="{ open: true }">
    <div class="flex min-h-screen">

         
            @include('layouts.sidebar') 
       

        <div class="fixed top-0 left-[300px] right-0 bg-white shadow-md h-20 z-10 transition-all duration-300" :class="open ? 'left-[300px]' : 'left-20'">
            @include('layouts.top-navbar') 
            <div class="flex items-center justify-between h-full px-8">
                
        </div>

        <main  :class="open ? 'ml-[5px]' : 'ml-5'" class="transition-all duration-300 pt-24 p-8 pb-40 relative flex-1 overflow-y-auto h-screen">

    <div class="max-w-6xl mx-auto">
        <h2 class="text-[42px] font-bold text-gray-800 dark:text-white mb-6 border-b border-gray-300 dark:border-gray-600 pb-2 tracking-wide flex items-center gap-4">
            <i class="fa-solid fa-id-badge text-blue-500 text-4xl w-10 h-10"></i>
            Recipients
        </h2>

        <div class="p-6 space-y-12">
            @if(session('success'))
                <div class="bg-green-100 text-green-800 border border-green-300 rounded p-3 mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <!-- ✅ Add Dropdown -->
            <div class="relative mb-4">
                <button onclick="toggleAddDropdown()" class="bg-[#4A90E2] hover:bg-[#357ABD] text-white font-medium px-6 py-2.5 rounded-full shadow-md hover:shadow-lg transition-all duration-300 ease-in-out mb-4 flex items-center space-x-2">
                   <i class="fas fa-plus"></i>
                <span>Add</span>
            </button>

               <div id="addDropdown" class="absolute z-50 mt-2 w-56 bg-white shadow-xl rounded-xl py-2 hidden transition-all duration-200">
    <button onclick="openModal('createRegionalModal'); closeAddDropdown();" class="flex items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-blue-600 transition-colors duration-150">
        <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
        </svg>
        Add Regional Office
    </button>
    <button onclick="openModal('createDivisionModal'); closeAddDropdown();" class="flex items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-blue-600 transition-colors duration-150">
        <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
        </svg>
        Add Division Office
    </button>
    <button onclick="openModal('createSchoolModal'); closeAddDropdown();" class="flex items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-blue-600 transition-colors duration-150">
        <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
        </svg>
        Add School
    </button>
    <button onclick="openModal('createRecipientModal'); closeAddDropdown();" class="flex items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-blue-600 transition-colors duration-150">
        <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
        </svg>
        Add Recipient
    </button>
</div>

</div>
            
           {{-- ✅ Regional Office Info Table --}}
<div id="regional-offices-table-wrapper" class="bg-white shadow rounded p-6">
    <h3 class="text-lg font-bold mb-4 flex items-center gap-2 text-[#1F2937]">
        📍 <span class="text-[#1F2937]">Regional Office Info</span>
    </h3>

    <div class="overflow-x-auto">
        <form method="POST" action="{{ route('regional-offices.import.csv') }}" enctype="multipart/form-data" class="mb-6 space-y-4">
            @csrf
            <div>

<label 
    for="regional_csv"
    class="inline-flex items-center gap-2 px-4 py-2 bg-white text-[#4A90E2] border border-[#4A90E2] rounded hover:bg-[#4A90E2] hover:text-white transition cursor-pointer">

    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M16 12l-4-4m0 0l-4 4m4-4v12" />
    </svg>
    Choose CSV File
</label>

<input 
    id="regional_csv"
    type="file" 
    name="csv_file" 
    accept=".csv" 
    required 
    class="hidden"
/>

<!-- Optional: Display file name after selection -->
<p id="regional-file-name" class="mt-3 px-4 py-2 text-sm text-gray-700 bg-gray-100 border border-gray-300 rounded-md shadow-sm max-w-full truncate mb-5">
    No file selected
</p>

            <button 
                type="submit" 
                class="flex items-center gap-2 px-4 py-2 bg-[#4A90E2] hover:bg-[#3a78bf] text-white font-medium rounded shadow transition mb-5">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Import Regional Offices
            </button>
        </form>

        <div class="overflow-x-auto rounded-lg mb-30">
            @include('recipients.partials.regional-offices-table', ['regionalOffices' => $regionalOffices])
        </div>
    </div>
</div>
</div>



           {{-- ✅ Division Office Info Table --}}
<div id="divisions-table-wrapper" class="bg-white shadow rounded p-6">
    <h3 class="text-lg font-bold mb-4 flex items-center gap-2 text-[#1F2937]">
        🏢 <span class="text-[#1F2937]">Division Office Info</span>
    </h3>

    <div class="overflow-x-auto">
        <form method="POST" action="{{ route('divisions.import') }}" enctype="multipart/form-data" class="mb-6 space-y-4">
            @csrf
            <div>
                <label 
                        for="divisions_csv"
                        class="inline-flex items-center gap-2 px-4 py-2 bg-white text-purple-600 border border-purple-600 rounded hover:bg-purple-600 hover:text-white transition cursor-pointer"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M16 12l-4-4m0 0l-4 4m4-4v12" />
                        </svg>
                        Choose CSV File
                    </label>

                    <input 
                        id="divisions_csv"
                        type="file" 
                        name="csv_file" 
                        accept=".csv" 
                        required 
                        class="hidden"
                    />

                    <p id="divisions-file-name" class="mt-3 px-4 py-2 text-sm text-gray-700 bg-gray-100 border border-gray-300 rounded-md shadow-sm max-w-full truncate mb-5">
                        No file selected
                    </p>


                <button 
                    type="submit" 
                class="flex items-center gap-2 px-4 py-2 bg-[#7C3AED] hover:bg-[#6D28D9] text-white font-medium rounded shadow transition mb-5"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Import Divisions
                </button>
            </div>
        </form>

        <div class="overflow-x-auto rounded-lg">
            @include('recipients.partials.divisions-table', ['divisions' => $divisions])
        </div>
    </div>
</div>

             

           {{-- ✅ School Info Table --}}
<div id="schools-table-wrapper" data-wrapper="schools-table-wrapper" class="bg-white shadow rounded p-6">
    <h3 class="text-lg font-bold mb-4 flex items-center gap-2 text-[#1F2937]">
        🏫 <span>School Info</span>
    </h3>

    <div class="overflow-x-auto">
        <form method="POST" action="{{ route('schools.import') }}" enctype="multipart/form-data" class="mb-6 space-y-4">
            @csrf
            <div>
                <label for="schools_csv" class="inline-flex items-center gap-2 px-4 py-2 bg-white text-[#10B981] border border-[#10B981] rounded hover:bg-[#10B981] hover:text-white transition cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M16 12l-4-4m0 0l-4 4m4-4v12" />
                    </svg>
                    Choose CSV File
                </label>
                <input 
                id="schools_csv"
                type="file" 
                name="csv_file" 
                accept=".csv" 
                required 
                class="hidden" 
                />

                <p id="schools-file-name" class="mt-3 px-4 py-2 text-sm text-gray-700 bg-gray-100 border border-gray-300 rounded-md shadow-sm max-w-full truncate mb-5">
                    No file selected
                </p>

                <button type="submit" class="flex items-center gap-2 px-4 py-2 bg-[#10B981] hover:bg-[#059669] text-white font-medium rounded shadow transition mb-5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Import Schools
                </button>
            </div>
        </form>

        <div class="overflow-x-auto rounded-lg">
            @include('recipients.partials.schools-table', ['schools' => $schools])
        </div>      
    </div>
</div>


           {{-- 📨 Recipients Table --}}
<div id="recipients-table-wrapper" data-wrapper="recipients-table-wrapper" class="bg-white shadow rounded p-6 mb-20">
    <h3 class="text-lg font-bold mb-4 flex items-center gap-2 text-[#1F2937]">
        📨 <span>Recipients</span>
    </h3>

    <div class="overflow-x-auto">
        <form method="POST" action="{{ route('recipients.import.csv') }}" enctype="multipart/form-data" class="mb-6 space-y-4">
            @csrf
            <div>
                <label for="recipients_csv" class="inline-flex items-center gap-2 px-4 py-2 bg-white text-[#F59E0B] border border-[#F59E0B] rounded hover:bg-[#F59E0B] hover:text-white transition cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M16 12l-4-4m0 0l-4 4m4-4v12" />
                    </svg>
                    Choose CSV File
                </label>
                <input id="recipients_csv" type="file" name="csv_file" accept=".csv" required class="hidden" />

                <p id="recipients-file-name" class="mt-3 px-4 py-2 text-sm text-gray-700 bg-gray-100 border border-gray-300 rounded-md shadow-sm max-w-full truncate mb-5">
                    No file selected
                </p>

                <button type="submit" class="flex items-center gap-2 px-4 py-2 bg-[#F59E0B] hover:bg-[#D97706] text-white font-medium rounded shadow transition mb-5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Import Recipients
                </button>
            </div>
        </form>

        <div class="overflow-x-auto rounded-lg">
            @include('recipients.partials.recipients-table', ['recipients' => $recipients])
        </div>

        <div class="mt-4">
            {{ $recipients->links('vendor.pagination.tailwind') }}
        </div>
    </div>
</div>


       <script>
document.addEventListener('DOMContentLoaded', function () {
    document.addEventListener('click', function (e) {
        const link = e.target.closest('.ajax-pagination');
        if (link) {
            e.preventDefault();
            const url = link.href;

            // Detect which table wrapper to update based on the clicked section
            let wrapperId = '';
            if (link.closest('#recipients-table-wrapper')) {
                wrapperId = 'recipients-table-wrapper';
            } else if (link.closest('#regionaloffices-table-wrapper')) {
                wrapperId = 'regionaloffices-table-wrapper';
            } else if (link.closest('#divisions-table-wrapper')) {
                wrapperId = 'divisions-table-wrapper';
            } else if (link.closest('#schools-table-wrapper')) {
                wrapperId = 'schools-table-wrapper';
            }

            if (!wrapperId) return;

            fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.text())
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');

                const newContent = doc.querySelector(`#${wrapperId}`);
                const target = document.querySelector(`#${wrapperId}`);

                if (newContent && target) {
                    target.innerHTML = newContent.innerHTML;
                }
            })
            .catch(error => console.error('Pagination error:', error));
        }
    });
});

</script>

</main>

        {{-- ✅ Modal Includes --}}
        @include('recipients.partials.create-school-modal')
        @include('recipients.partials.edit-school-modal')
        @include('recipients.partials.create-division-office-modal')
        @include('recipients.partials.edit-division-office-modal')
        @include('recipients.partials.create-regional-office-modal')
        @foreach ($regionalOffices as $ro)
        @include('recipients.partials.edit-regional-office-modal', ['ro' => $ro])
        @endforeach
        @include('recipients.partials.create-recipient-modal')
        @include('recipients.partials.edit-recipient-modal')

        <!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6 relative animate-fadeInUp font-['Poppins']">
        <!-- Close Button -->
        <button onclick="closeModal('deleteModal')"
                class="absolute top-3 right-3 text-gray-500 hover:text-gray-700 text-2xl leading-none">
            &times;
        </button>

        <!-- Header -->
        <h2 class="text-xl font-bold text-gray-800 mb-3 text-center">🗑️ Confirm Deletion</h2>
        <p class="text-sm text-gray-600 mb-6 text-center">Are you sure you want to delete this record? This action cannot be undone.</p>

        <!-- Form -->
        <form id="deleteForm" method="POST">
            @csrf
            @method('DELETE')

            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeModal('deleteModal')"
                        class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                    Cancel
                </button>
                <button type="submit"
                        class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                    Delete
                </button>
            </div>
        </form>
    </div>
</div>




       {{-- ✅ JavaScript --}}
    <script>

        //For Modals
        function openModal(id) {
        const modal = document.getElementById(id);
        modal.classList.remove('hidden');
        setTimeout(() => {
            modal.classList.add('flex');
            modal.classList.remove('opacity-0');
            modal.classList.add('opacity-100');
        }, 10); // Allow DOM to register the visibility change
    }

        function closeModal(id) {
        const modal = document.getElementById(id);
        modal.classList.add('opacity-0');
        modal.classList.remove('opacity-100');
        setTimeout(() => {
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }, 300); // Match your transition-duration
    }


        function toggleAddDropdown() {
            document.getElementById('addDropdown').classList.toggle('hidden');
        }

        function closeAddDropdown() {
            document.getElementById('addDropdown').classList.add('hidden');
        }

        document.addEventListener('DOMContentLoaded', function () {
    const closeAddModalBtn = document.getElementById('closeAddModalBtn');
    if (closeAddModalBtn) {
        closeAddModalBtn.addEventListener('click', function () {
            closeModal('createRegionalModal');
        });
    }
});

        function openEditSchoolModal(school) {
            document.getElementById('editSchoolId').value = school.school_id;
            document.getElementById('editSchoolName').value = school.school_name;
            document.getElementById('editSchoolAddress').value = school.school_address;
            document.getElementById('editDivisionId').value = school.division_id;
            document.getElementById('editHasInternet').value = school.has_internet;
            document.getElementById('editInternetProvider').value = school.internet_provider;
            document.getElementById('editElectricityProvider').value = school.electricity_provider;
            document.getElementById('editSchoolForm').action = `/recipients/school/${school.school_id}`;
            openModal('editSchoolModal');
        }

        function openEditDivisionModal(division) {
            document.getElementById('editDivisionId').value = division.division_id;
            document.getElementById('editDivisionName').value = division.division_name;
            document.getElementById('editRegionalOfficeId').value = division.regional_office_id;
            document.getElementById('editDivisionForm').action = `/recipients/division/${division.division_id}`;
            openModal('editDivisionModal');
        }

        function openEditModal(id) {
            const modal = document.getElementById(`editRegionalModal-${id}`);
            if (modal) {
                modal.classList.remove('hidden');
            }
        }

        function closeEditModal(id) {
            const modal = document.getElementById(`editRegionalModal-${id}`);
            if (modal) {
                modal.classList.add('hidden');
            }
        }

        function openEditRecipientModal(id, contact_person, position, contact_number, quantity) {
            const form = document.getElementById('editRecipientForm');
            form.action = `/recipients/${id}`;

            document.getElementById('edit_contact_person').value = contact_person;
            document.getElementById('edit_position').value = position;
            document.getElementById('edit_contact_number').value = contact_number;
            document.getElementById('edit_quantity').value = quantity;

            openModal('editRecipientModal');
        }

        function openModal(id) {
            const modal = document.getElementById(id);
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeModal(id) {
            const modal = document.getElementById(id);
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        function openDeleteModal(type, id) {
            const form = document.getElementById('deleteForm');
            form.action = `/recipients/${type}/${id}`;
            openModal('deleteModal');
        }


    // For CSV Uploading
   
    // Regional Office
    document.getElementById('regional_csv')?.addEventListener('change', function (e) {
        const fileName = e.target.files[0]?.name || 'No file selected';
        document.getElementById('regional-file-name').textContent = fileName;
    });

    // Division Office
    document.getElementById('divisions_csv')?.addEventListener('change', function (e) {
        const fileName = e.target.files[0]?.name || 'No file selected';
        document.getElementById('divisions-file-name').textContent = fileName;
    });

    // School
    document.getElementById('schools_csv')?.addEventListener('change', function (e) {
        const fileName = e.target.files[0]?.name || 'No file selected';
        document.getElementById('schools-file-name').textContent = fileName;
    });

    // Recipients
    document.getElementById('recipients_csv')?.addEventListener('change', function (e) {
        const fileName = e.target.files[0]?.name || 'No file selected';
        document.getElementById('recipients-file-name').textContent = fileName;
    });
</script>

</body>
</html>