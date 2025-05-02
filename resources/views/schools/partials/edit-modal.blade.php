<!-- Edit School Modal -->
<div id="editModal_{{ $school->school_id }}" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
    <div class="bg-white p-6 rounded-lg w-full max-w-2xl relative">
        <button onclick="document.getElementById('editModal_{{ $school->school_id }}').classList.add('hidden')" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">✖</button>

        <h2 class="text-xl font-semibold mb-4">Edit School</h2>

        <form method="POST" action="{{ route('schools.update', $school->school_id) }}">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-medium">School ID</label>
                    <input type="text" name="school_id" class="w-full border rounded px-3 py-2 bg-gray-100" value="{{ $school->school_id }}" readonly>
                </div>

                <div>
                    <label class="block font-medium">School Name</label>
                    <input type="text" name="school_name" class="w-full border rounded px-3 py-2" value="{{ $school->school_name }}" required>
                </div>

                <div>
                    <label class="block font-medium">School Address</label>
                    <input type="text" name="school_address" class="w-full border rounded px-3 py-2" value="{{ $school->school_address }}" required>
                </div>

                <div>
                    <label class="block font-medium">School Head</label>
                    <input type="text" name="school_head" class="w-full border rounded px-3 py-2" value="{{ $school->school_head }}" required>
                </div>

                <div>
                    <label class="block font-medium">Level</label>
                    <select name="level" class="w-full border rounded px-3 py-2" required>
                        <option value="Elementary" {{ $school->level == 'Elementary' ? 'selected' : '' }}>Elementary</option>
                        <option value="Secondary" {{ $school->level == 'Secondary' ? 'selected' : '' }}>Secondary</option>
                        <option value="Senior High School" {{ $school->level == 'Senior High School' ? 'selected' : '' }}>Senior High School</option>
                    </select>
                </div>

                <div>
                    <label class="block font-medium">Division</label>
                    <select name="division_id" class="w-full border rounded px-3 py-2" required>
                        @foreach ($divisions as $division)
                            <option value="{{ $division->division_id }}" {{ $school->division_id == $division->division_id ? 'selected' : '' }}>
                                {{ $division->division_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block font-medium">Municipality</label>
                    <select name="municipality_id" class="w-full border rounded px-3 py-2" required>
                        @foreach ($municipalities as $municipality)
                            <option value="{{ $municipality->municipality_id }}" {{ $school->municipality_id == $municipality->municipality_id ? 'selected' : '' }}>
                                {{ $municipality->municipality_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mt-6 text-right">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
            </div>
        </form>
    </div>
</div>
