<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white">
            Edit School - {{ $school->school_name }}
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

        <form method="POST" action="{{ route('schools.update', $school->school_id) }}">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <!-- School ID -->
                <div>
                    <label class="block font-medium">School ID</label>
                    <input type="text" name="school_id" value="{{ old('school_id', $school->school_id) }}" class="w-full border rounded px-3 py-2" required>
                </div>

                <!-- School Name -->
                <div>
                    <label class="block font-medium">School Name</label>
                    <input type="text" name="school_name" value="{{ old('school_name', $school->school_name) }}" class="w-full border rounded px-3 py-2" required>
                </div>

                <!-- School Address -->
                <div>
                    <label class="block font-medium">School Address</label>
                    <input type="text" name="school_address" value="{{ old('school_address', $school->school_address) }}" class="w-full border rounded px-3 py-2" required>
                </div>

                <!-- School Head -->
                <div>
                    <label class="block font-medium">School Head</label>
                    <input type="text" name="school_head" value="{{ old('school_head', $school->school_head) }}" class="w-full border rounded px-3 py-2" required>
                </div>

                <!-- Level -->
                <div>
                    <label class="block font-medium">Level</label>
                    <select name="level" class="w-full border rounded px-3 py-2" required>
                        <option value="">Select Level</option>
                        <option value="Elementary" {{ $school->level === 'Elementary' ? 'selected' : '' }}>Elementary</option>
                        <option value="High School" {{ $school->level === 'High School' ? 'selected' : '' }}>High School</option>
                    </select>
                </div>

                <!-- Division -->
                <div>
                    <label class="block font-medium">Division</label>
                    <select name="division_id" class="w-full border rounded px-3 py-2" required>
                        <option value="{{ $division->division_id }}">{{ $division->division_name }}</option>
                    </select>
                </div>

                <!-- Municipality -->
                <div>
                    <label class="block font-medium">Municipality</label>
                    <select name="municipality_id" class="w-full border rounded px-3 py-2" required>
                        <option value="">Select Municipality</option>
                        @foreach ($municipalities as $municipality)
                            <option value="{{ $municipality->municipality_id }}"
                                {{ $school->municipality_id == $municipality->municipality_id ? 'selected' : '' }}>
                                {{ $municipality->municipality_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mt-6">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Update School
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
