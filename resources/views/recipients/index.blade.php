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
    <div class="flex min-h-screen">

         
            @include('layouts.sidebar') 
       

        <div class="fixed top-0 left-[300px] right-0 bg-white shadow-md h-20 z-10 transition-all duration-300" :class="open ? 'left-[300px]' : 'left-20'">
            @include('layouts.top-navbar') 
            <div class="flex items-center justify-between h-full px-8">
                
        </div>

        <main  :class="open ? 'ml-[5px]' : 'ml-5'" class="transition-all duration-300 pt-24 p-8 relative flex-1 overflow-y-auto h-screen"
>
    <div class="max-w-6xl mx-auto">
        <h2 class="text-[42px] font-bold text-gray-800 dark:text-white mb-6 border-b border-gray-300 dark:border-gray-600 pb-2 tracking-wide">
            👥 Recipients
        </h2>
            

        <div class="p-6 space-y-12">
            @if(session('success'))
                <div class="bg-green-100 text-green-800 border border-green-300 rounded p-3 mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <!-- ✅ Add Dropdown -->
            <div class="relative mb-4">
                <button onclick="toggleAddDropdown()" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    + Add
                </button>
                <div id="addDropdown" class="absolute z-10 mt-2 bg-white shadow-md rounded hidden w-48">
                    <button onclick="openModal('createRegionalModal'); closeAddDropdown();" class="w-full text-left px-4 py-2 hover:bg-gray-100"> ➕ Add Regional Office</button>
                    <button onclick="openModal('createDivisionModal'); closeAddDropdown();" class="w-full text-left px-4 py-2 hover:bg-gray-100">➕ Add Division Office</button>
                    <button onclick="openModal('createSchoolModal'); closeAddDropdown();" class="w-full text-left px-4 py-2 hover:bg-gray-100">➕ Add School</button>
                    <button onclick="openModal('createRecipientModal'); closeAddDropdown();" class="w-full text-left px-4 py-2 hover:bg-gray-100">➕ Add Recipient</button>
                </div>
            </div>
            
            {{-- ✅ Regional Office Info Table --}}
            <div id="regional-offices-table-wrapper" class="bg-white shadow rounded p-4">
                <h3 class="text-lg font-bold mb-4">Regional Office Info</h3>
                <div class="overflow-x-auto">
                    <form method="POST" action="{{ route('regional-offices.import.csv') }}" enctype="multipart/form-data" class="mb-6">
                        @csrf
                        <label class="block font-semibold mb-2">Upload Regional Offices CSV</label>
                        <input type="file" name="csv_file" accept=".csv" required class="mb-2 border rounded">
                        <button type="submit" class="px-4 py-2 bg-pink-600 hover:bg-pink-700 text-white rounded">Import Regional Offices</button>
                    </form>
                    <div class="overflow-x-auto rounded-lg">
                       @include('recipients.partials.regional-offices-table', ['regionalOffices' => $regionalOffices])
            </div>
        </div>
    </div>


            {{-- ✅ Division Office Info Table --}}
            <div id="divisions-table-wrapper" class="bg-white shadow rounded p-4">
                <h3 class="text-lg font-bold mb-4">Division Office Info</h3>
                <div class="overflow-x-auto">
                    <form method="POST" action="{{ route('divisions.import') }}" enctype="multipart/form-data" class="mb-6">
                        @csrf
                        <label class="block font-semibold mb-2">Upload Divisions CSV</label>
                        <input type="file" name="csv_file" accept=".csv" required class="mb-2 border rounded">
                        <button type="submit" class="px-4 py-2 bg-purple-600 text-white rounded">Import Divisions</button>
                    </form>
                    <div class="overflow-x-auto rounded-lg">
                        @include('recipients.partials.divisions-table', ['divisions' => $divisions])
                    </div>
                </div>
                
            </div>
             

            {{-- ✅ School Info Table --}}
            <div id="schools-table-wrapper" data-wrapper="schools-table-wrapper" class="bg-white shadow rounded p-4">
                <h3 class="text-lg font-bold mb-4">School Info</h3>
                <div class="overflow-x-auto">
                    <form method="POST" action="{{ route('schools.import') }}" enctype="multipart/form-data" class="mb-6">
                        @csrf
                        <label class="block font-semibold mb-2">Upload Schools CSV</label>
                        <input type="file" name="csv_file" accept=".csv" required class="mb-2 border rounded">
                        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded">Import Schools</button>
                    </form>
                    
                    <div class="overflow-x-auto rounded-lg">
                     @include('recipients.partials.schools-table', ['schools' => $schools])
                    </div>      
           
                </div>
            </div>

            {{-- Recipients Table --}}
            <div id="recipients-table-wrapper" data-wrapper="recipients-table-wrapper" class="bg-white shadow rounded p-4 mb-20">
                <h3 class="text-lg font-bold mb-4">Recipients</h3>
                <div class="overflow-x-auto">
                    <form method="POST" action="{{ route('recipients.import.csv') }}" enctype="multipart/form-data" class="mb-6">
                        @csrf
                        <label class="block font-semibold mb-2">Upload Recipients CSV</label>
                        <input type="file" name="csv_file" accept=".csv" required class="mb-2 border rounded">
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Import Recipients</button>
                    </form>
                    <div class="overflow-x-auto rounded-lg">
                        @include('recipients.partials.recipients-table', ['recipients' => $recipients])
                    </div>

                    <div class="mt-4">
                        {{ $recipients->links('vendor.pagination.tailwind') }}
                    </div>

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
        <div id="deleteModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-50 hidden justify-center items-center">
            <div class="bg-white w-full max-w-md rounded-lg shadow-lg p-6 relative">
                <h2 class="text-lg font-bold mb-4 text-center">Confirm Deletion</h2>
                <p class="mb-4 text-center text-gray-700">Are you sure you want to delete this record?</p>

                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="flex justify-end gap-2">
                        <button type="button" onclick="closeModal('deleteModal')" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Delete</button>
                    </div>
                </form>

                <button class="absolute top-2 right-2 text-gray-500 hover:text-gray-700" onclick="closeModal('deleteModal')">&times;</button>
            </div>
        </div>



       {{-- ✅ JavaScript --}}
    <script>
        function openModal(id) {
            document.getElementById(id).classList.remove('hidden');
            document.getElementById(id).classList.add('flex');
        }

        function closeModal(id) {
            document.getElementById(id).classList.remove('flex');
            document.getElementById(id).classList.add('hidden');
        }

        function toggleAddDropdown() {
            document.getElementById('addDropdown').classList.toggle('hidden');
        }

        function closeAddDropdown() {
            document.getElementById('addDropdown').classList.add('hidden');
        }

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
    </script>
</body>
</html>