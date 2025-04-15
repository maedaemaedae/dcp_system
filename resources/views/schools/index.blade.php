<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white">
            School Management
        </h2>
    </x-slot>

    <div class="p-6">
        @if (session('success'))
            <div class="mb-4 text-green-600 font-medium">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-4">
            <a href="{{ route('schools.create') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                + Add School
            </a>
        </div>

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
                            <td class="px-4 py-2 space-x-2">
                            <a href="{{ route('schools.edit', $school->school_id) }}"
                            class="bg-yellow-500 text-white px-2 py-1 rounded text-xs hover:bg-yellow-600">Edit</a>

                            <form action="{{ route('schools.destroy', $school->school_id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Are you sure?')" class="bg-red-600 text-white px-2 py-1 rounded text-xs hover:bg-red-700">
                                    Delete
                                </button>
                            </form>
                        </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center text-gray-500 py-4">
                                No schools found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
