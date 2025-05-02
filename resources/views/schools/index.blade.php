<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white">
            School Management
        </h2>
    </x-slot>

    <div class="p-6">
        <div class="mb-4">
            <a href="{{ route('schools.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                + Add School
            </a>
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
                        <th class="px-4 py-2 text-left font-medium text-gray-600">School ID</th>
                        <th class="px-4 py-2 text-left font-medium text-gray-600">Name</th>
                        <th class="px-4 py-2 text-left font-medium text-gray-600">Division</th>
                        <th class="px-4 py-2 text-left font-medium text-gray-600">Municipality</th>
                        <th class="px-4 py-2 text-left font-medium text-gray-600">Level</th>
                        <th class="px-4 py-2 text-left font-medium text-gray-600">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($schools as $school)
                        <tr>
                            <td class="px-4 py-2">{{ $school->school_id }}</td>
                            <td class="px-4 py-2">{{ $school->school_name }}</td>
                            <td class="px-4 py-2">{{ $school->division->division_name ?? 'N/A' }}</td>
                            <td class="px-4 py-2">{{ $school->municipality->municipality_name ?? 'N/A' }}</td>
                            <td class="px-4 py-2">{{ $school->level }}</td>
                            <td class="px-4 py-2">
                                <button onclick="document.getElementById('editModal_{{ $school->school_id }}').classList.remove('hidden')" class="text-blue-600 hover:underline mr-2">Edit</button>
                                <button onclick="document.getElementById('deleteModal_{{ $school->school_id }}').classList.remove('hidden')" class="text-red-600 hover:underline">Delete</button>
                            </td>
                        </tr>

                        @include('schools.partials.edit-modal', ['school' => $school, 'divisions' => $divisions, 'municipalities' => $municipalities])
                        @include('schools.partials.delete-modal', ['school' => $school])
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-4 text-center text-gray-500">No schools found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
