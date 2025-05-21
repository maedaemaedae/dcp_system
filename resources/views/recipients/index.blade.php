<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white">
            Recipients Overview
        </h2>
    </x-slot>

    <div class="p-6 space-y-12">

        <!-- ✅ Add Dropdown -->
        <div class="relative mb-4">
            <button onclick="toggleAddDropdown()" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                + Add
            </button>
            <div id="addDropdown" class="absolute z-10 mt-2 bg-white shadow-md rounded hidden w-48">
                <button onclick="openModal('createSchoolModal'); closeAddDropdown();" class="w-full text-left px-4 py-2 hover:bg-gray-100">➕ Add School</button>
                <button onclick="openModal('createDivisionModal'); closeAddDropdown();" class="w-full text-left px-4 py-2 hover:bg-gray-100">➕ Add Division</button>
            </div>
        </div>

        {{-- ✅ School Info Table --}}
        <div class="bg-white shadow rounded p-4">
            <h3 class="text-lg font-bold mb-4">School Info</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left border border-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2">School ID</th>
                            <th class="px-4 py-2">Name</th>
                            <th class="px-4 py-2">Address</th>
                            <th class="px-4 py-2">Internet?</th>
                            <th class="px-4 py-2">ISP</th>
                            <th class="px-4 py-2">Electricity</th>
                            <th class="px-4 py-2">Division</th>
                            <th class="px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($schools as $school)
                            <tr class="border-t">
                                <td class="px-4 py-2">{{ $school->school_id }}</td>
                                <td class="px-4 py-2">{{ $school->school_name }}</td>
                                <td class="px-4 py-2">{{ $school->school_address }}</td>
                                <td class="px-4 py-2">{!! $school->has_internet ? '✅' : '❌' !!}</td>
                                <td class="px-4 py-2">{{ $school->internet_provider }}</td>
                                <td class="px-4 py-2">{{ $school->electricity_provider }}</td>
                                <td class="px-4 py-2">{{ $school->division->division_name ?? 'N/A' }}</td>
                                <td class="px-4 py-2 flex gap-2">
                                    <button onclick='openEditSchoolModal(@json($school))' class="text-blue-600 hover:underline">Edit</button>
                                    <button onclick='openDeleteModal("school", {{ $school->school_id }})' class="text-red-600 hover:underline">Delete</button>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- ✅ Division Info Table --}}
        <div class="bg-white shadow rounded p-4">
            <h3 class="text-lg font-bold mb-4">Division Info</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left border border-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2">Division ID</th>
                            <th class="px-4 py-2">Division Name</th>
                            <th class="px-4 py-2">Regional Office</th>
                            <th class="px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($divisions as $division)
                            <tr class="border-t">
                                <td class="px-4 py-2">{{ $division->division_id }}</td>
                                <td class="px-4 py-2">{{ $division->division_name }}</td>
                                <td class="px-4 py-2">{{ $division->regionalOffice->ro_office ?? 'N/A' }}</td>
                                <td class="px-4 py-2 flex gap-2">
                                    <button onclick='openEditDivisionModal(@json($division))' class="text-blue-600 hover:underline">Edit</button>
                                    <button onclick='openDeleteModal("division", {{ $division->division_id }})' class="text-red-600 hover:underline">Delete</button>
                                </td>                            
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- ✅ Modal Includes --}}
    @include('recipients.partials.create-school-modal')
    @include('recipients.partials.edit-school-modal')
    @include('recipients.partials.create-division-office-modal')
    @include('recipients.partials.edit-division-office-modal')

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

        function openDeleteModal(type, id) {
            const form = document.getElementById('deleteForm');
            form.action = `/recipients/${type}/${id}`;
            openModal('deleteModal');
        }
    </script>
</x-app-layout>
