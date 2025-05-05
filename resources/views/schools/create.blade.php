<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white">
            Add New School
        </h2>
    </x-slot>

    <div class="p-6">
        @if ($errors->any())
            <div class="mb-4 text-red-600">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('schools.store') }}">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- School ID -->
                <div>
                    <label class="block font-medium">School ID</label>
                    <input type="text" name="school_id" class="w-full border rounded px-3 py-2" required>
                </div>

                <!-- School Name -->
                <div>
                    <label class="block font-medium">School Name</label>
                    <input type="text" name="school_name" class="w-full border rounded px-3 py-2" required>
                </div>

                <!-- School Address -->
                <div>
                    <label class="block font-medium">School Address</label>
                    <input type="text" name="school_address" class="w-full border rounded px-3 py-2" required>
                </div>

                <!-- School Head -->
                <div>
                    <label class="block font-medium">School Head</label>
                    <input type="text" name="school_head" class="w-full border rounded px-3 py-2" required>
                </div>

                <!-- Level Dropdown -->
                <div>
                    <label class="block font-medium">Level</label>
                    <select name="level" class="w-full border rounded px-3 py-2" required>
                        <option value="">Select Level</option>
                        <option value="Elementary">Elementary</option>
                        <option value="High School">High School</option>
                    </select>
                </div>

                <!-- Division (Fixed to Region IV-B) -->
                <div>
                    <label class="block font-medium">Division</label>
                    <select name="division_id" class="w-full border rounded px-3 py-2" required>
                        <option value="{{ $division->division_id }}">{{ $division->division_name }}</option>
                    </select>
                </div>

                <!-- Municipality Dropdown -->
                <div>
                    <label class="block font-medium">Municipality</label>
                    <select name="municipality_id" class="w-full border rounded px-3 py-2" required>
                        <option value="">Select Municipality</option>
                        @foreach ($municipalities as $municipality)
                            <option value="{{ $municipality->municipality_id }}">{{ $municipality->municipality_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="mt-6">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Save School
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
