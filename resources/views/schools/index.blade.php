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
                        <th class="px-4 py-2 text-left">School Name</th>
                        <th class="px-4 py-2 text-left">Address</th>
                        <th class="px-4 py-2 text-left">School Head</th>
                        <th class="px-4 py-2 text-left">Level</th>
                        <th class="px-4 py-2 text-left">Division</th>
                        <th class="px-4 py-2 text-left">Municipality</th>
                        <th class="px-4 py-2 text-left">Created By</th>
                        <th class="px-4 py-2 text-left">Created Date</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($schools as $school)
                        <tr>
                            <td class="px-4 py-2">{{ $school->school_name }}</td>
                            <td class="px-4 py-2">{{ $school->school_address }}</td>
                            <td class="px-4 py-2">{{ $school->school_head }}</td>
                            <td class="px-4 py-2">{{ $school->level }}</td>
                            <td class="px-4 py-2">{{ $school->division->division_name ?? '—' }}</td>
                            <td class="px-4 py-2">{{ $school->municipality->municipality_name ?? '—' }}</td>
                            <td class="px-4 py-2">{{ $school->created_by }}</td>
                            <td class="px-4 py-2">{{ $school->created_date }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-4 py-4 text-center text-gray-500">No schools found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
