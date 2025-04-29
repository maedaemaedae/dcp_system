<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white">
            School Management
        </h2>
    </x-slot>

    <div class="p-6">
        <div class="mb-4">
            <button onclick="openCreateModal()" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                + Add School
            </button>
        </div>

        <form method="GET" action="{{ route('schools.index') }}" class="mb-4 flex items-center gap-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by ID, Name, or Address..." class="w-full md:w-1/3 border rounded px-3 py-2">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Search
            </button>
        </form>

        <div class="overflow-x-auto bg-white shadow-md rounded">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left">School ID</th>
                        <th class="px-4 py-2 text-left">School Name</th>
                        <th class="px-4 py-2 text-left">Address</th>
                        <th class="px-4 py-2 text-left">School Head</th>
                        <th class="px-4 py-2 text-left">Level</th>
                        <th class="px-4 py-2 text-left">Division</th>
                        <th class="px-4 py-2 text-left">Municipality</th>
                        <th class="px-4 py-2 text-left">Created By</th>
                        <th class="px-4 py-2 text-left">Created Date</th>
                        <th class="px-4 py-2 text-left">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">
                    @forelse ($schools as $school)
                        <tr>
                            <td class="px-4 py-2">{{ $school->school_id }}</td>
                            <td class="px-4 py-2">{{ $school->school_name }}</td>
                            <td class="px-4 py-2">{{ $school->school_address }}</td>
                            <td class="px-4 py-2">{{ $school->school_head }}</td>
                            <td class="px-4 py-2">{{ $school->level }}</td>
                            <td class="px-4 py-2">{{ $school->division->division_name ?? '—' }}</td>
                            <td class="px-4 py-2">{{ $school->municipality->municipality_name ?? '—' }}</td>
                            <td class="px-4 py-2">{{ $school->created_by }}</td>
                            <td class="px-4 py-2">{{ $school->created_date }}</td>
                            <td class="px-4 py-2">
                                <div class="flex space-x-2">
                                    @php
                                        $schoolJson = json_encode([
                                            "school_id" => $school->school_id,
                                            "school_name" => $school->school_name,
                                            "school_address" => $school->school_address,
                                            "school_head" => $school->school_head,
                                            "level" => $school->level,
                                            "division" => [
                                                "division_id" => $school->division->division_id ?? null
                                            ],
                                            "municipality" => [
                                                "municipality_id" => $school->municipality->municipality_id ?? null
                                            ]
                                        ]);
                                    @endphp

                                    <button 
                                        data-school='{{ $schoolJson }}'
                                        onclick="handleEditClick(this)"
                                        class="bg-yellow-500 text-white px-3 py-1 rounded text-xs hover:bg-yellow-600">
                                        Edit
                                    </button>

                                    <form action="{{ route('schools.destroy', $school->school_id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Are you sure?')"
                                            class="bg-red-600 text-white px-3 py-1 rounded text-xs hover:bg-red-700">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center text-gray-500 py-4">
                                No schools found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Include Create Modal -->
    @include('schools.partials.create-modal')

    <!-- Include Edit Modal -->
    @include('schools.partials.edit-modal')

    <script>
        function openCreateModal() {
            document.getElementById('createModal').classList.remove('hidden');
        }

        function handleEditClick(button) {
            const school = JSON.parse(button.getAttribute('data-school'));
            openEditModal(school);
        }

        function openEditModal(school) {
            document.getElementById('editModal').classList.remove('hidden');
            const form = document.getElementById('editSchoolForm');
            form.action = `/schools/${school.school_id}`;

            document.getElementById('edit_school_id').value = school.school_id ?? '';
            document.getElementById('edit_school_name').value = school.school_name ?? '';
            document.getElementById('edit_school_address').value = school.school_address ?? '';
            document.getElementById('edit_school_head').value = school.school_head ?? '';
            document.getElementById('edit_level').value = school.level ?? '';
            document.getElementById('edit_division_id').value = school.division?.division_id ?? '';
            document.getElementById('edit_municipality_id').value = school.municipality?.municipality_id ?? '';
        }

        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
        }
    </script>

    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const toast = document.createElement('div');
                let message = "{{ session('success') }}";

                if (message.includes('Added')) {
                    message = '✔ ' + message;
                } else if (message.includes('Updated')) {
                    message = '\u270F\uFE0F ' + message;
                } else if (message.includes('Removed')) {
                    message = '🗑 ' + message;
                }

                toast.innerText = message;
                toast.className = "fixed bottom-1 left-1/2 transform -translate-x-1/2 bg-green-500 text-white py-4 px-8 rounded-lg shadow-lg z-50 text-center text-lg font-semibold";
                document.body.appendChild(toast);

                setTimeout(() => {
                    toast.remove();
                }, 3000);
            });
        </script>
    @endif
</x-app-layout>
