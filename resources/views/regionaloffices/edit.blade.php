<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white">
            Edit Regional Office
        </h2>
    </x-slot>

    <div class="p-6">
        <form method="POST" action="{{ route('regional-offices.update', $regionalOffice->ro_id) }}">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-medium">Office Name</label>
                    <input type="text" name="ro_office" value="{{ $regionalOffice->ro_office }}" class="w-full border rounded px-3 py-2" required>
                </div>
                <div>
                    <label class="block font-medium">Person in Charge</label>
                    <input type="text" name="person_in_charge" value="{{ $regionalOffice->person_in_charge }}" class="w-full border rounded px-3 py-2" required>
                </div>
                <div>
                    <label class="block font-medium">Email</label>
                    <input type="email" name="email" value="{{ $regionalOffice->email }}" class="w-full border rounded px-3 py-2">
                </div>
                <div>
                    <label class="block font-medium">Contact No.</label>
                    <input type="text" name="contact_no" value="{{ $regionalOffice->contact_no }}" class="w-full border rounded px-3 py-2">
                </div>
            </div>

            <div class="mt-6">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Update
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
