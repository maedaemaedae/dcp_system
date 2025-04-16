<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white">
            Division Offices
        </h2>
    </x-slot>

    <div class="p-6">
        @if (session('success'))
            <div class="mb-4 text-green-600 font-medium">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('division-offices.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mb-4 inline-block">
            + Add Division Office
        </a>

        <div class="overflow-x-auto bg-white rounded shadow">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left">Division Name</th>
                        <th class="px-4 py-2 text-left">Person in Charge</th>
                        <th class="px-4 py-2 text-left">Region</th>
                        <th class="px-4 py-2 text-left">Email</th>
                        <th class="px-4 py-2 text-left">Contact No.</th>
                        <th class="px-4 py-2 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($divisions as $division)
                        <tr class="border-b">
                            <td class="px-4 py-2">{{ $division->division_name }}</td>
                            <td class="px-4 py-2">{{ $division->person_in_charge }}</td>
                            <td class="px-4 py-2">{{ $division->regionalOffice->ro_office ?? '—' }}</td>
                            <td class="px-4 py-2">{{ $division->email }}</td>
                            <td class="px-4 py-2">{{ $division->contact_no }}</td>
                            <td class="px-4 py-2 space-x-2">
                                <a href="{{ route('division-offices.edit', $division->division_id) }}" class="bg-yellow-500 text-white px-2 py-1 rounded text-xs hover:bg-yellow-600">Edit</a>
                                <form action="{{ route('division-offices.destroy', $division->division_id) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button onclick="return confirm('Are you sure?')" class="bg-red-600 text-white px-2 py-1 rounded text-xs hover:bg-red-700">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center py-4 text-gray-500">No divisions found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
