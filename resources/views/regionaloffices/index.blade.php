<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white">
            Regional Offices
        </h2>
    </x-slot>

    <div class="p-6">
        @if (session('success'))
            <div class="mb-4 text-green-600 font-medium">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('regional-offices.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mb-4 inline-block">
            + Add Regional Office
        </a>

        <div class="overflow-x-auto bg-white rounded shadow">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left">Office</th>
                        <th class="px-4 py-2 text-left">In Charge</th>
                        <th class="px-4 py-2 text-left">Email</th>
                        <th class="px-4 py-2 text-left">Contact No.</th>
                        <th class="px-4 py-2 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($regionalOffices as $ro)
                        <tr class="border-b">
                            <td class="px-4 py-2">{{ $ro->ro_office }}</td>
                            <td class="px-4 py-2">{{ $ro->person_in_charge }}</td>
                            <td class="px-4 py-2">{{ $ro->email }}</td>
                            <td class="px-4 py-2">{{ $ro->contact_no }}</td>
                            <td class="px-4 py-2 space-x-2">
                                <a href="{{ route('regional-offices.edit', $ro->ro_id) }}" class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600 text-xs">Edit</a>
                                <form action="{{ route('regional-offices.destroy', $ro->ro_id) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button onclick="return confirm('Are you sure?')" class="bg-red-600 text-white px-2 py-1 rounded hover:bg-red-700 text-xs">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-gray-500 py-4">No regional offices found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
