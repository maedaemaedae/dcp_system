<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white">
            Add Division Office
        </h2>
    </x-slot>

    <div class="p-6">
        <form method="POST" action="{{ route('division-offices.store') }}">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-medium">Division Name</label>
                    <input type="text" name="division_name" class="w-full border rounded px-3 py-2" required>
                </div>
                <div>
                    <label class="block font-medium">Person in Charge</label>
                    <input type="text" name="person_in_charge" class="w-full border rounded px-3 py-2" required>
                </div>
                <div>
                    <label class="block font-medium">Email</label>
                    <input type="email" name="email" class="w-full border rounded px-3 py-2">
                </div>
                <div>
                    <label class="block font-medium">Contact No.</label>
                    <input type="text" name="contact_no" class="w-full border rounded px-3 py-2">
                </div>
                <div>
                    <label class="block font-medium">Region</label>
                    <select name="regional_office_id" class="w-full border rounded px-3 py-2" required>
                        <option value="">-- Select Region --</option>
                        @foreach ($regionalOffices as $region)
                            <option value="{{ $region->ro_id }}">{{ $region->ro_office }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mt-6">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Save</button>
            </div>
        </form>
    </div>
</x-app-layout>
