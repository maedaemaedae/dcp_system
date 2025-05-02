<div id="editModal-{{ $division->division_id }}" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white p-6 rounded shadow-lg w-full max-w-2xl relative">
        <button onclick="closeEditModal({{ $division->division_id }})" class="absolute top-2 right-2 text-gray-500 text-xl hover:text-black">&times;</button>

        <h2 class="text-xl font-semibold mb-4">Edit Division Office</h2>

        <form method="POST" action="{{ route('division-offices.update', $division->division_id) }}">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-medium">Division Name</label>
                    <input type="text" name="division_name" value="{{ $division->division_name }}" class="w-full border rounded px-3 py-2" required>
                </div>
                <div>
                    <label class="block font-medium">Person in Charge</label>
                    <input type="text" name="person_in_charge" value="{{ $division->person_in_charge }}" class="w-full border rounded px-3 py-2" required>
                </div>
                <div>
                    <label class="block font-medium">Email</label>
                    <input type="email" name="email" value="{{ $division->email }}" class="w-full border rounded px-3 py-2">
                </div>
                <div>
                    <label class="block font-medium">Contact No.</label>
                    <input type="text" name="contact_no" value="{{ $division->contact_no }}" class="w-full border rounded px-3 py-2">
                </div>
                <div>
                    <label class="block font-medium">Region</label>
                    <select name="regional_office_id" class="w-full border rounded px-3 py-2" required>
                        @foreach ($regionalOffices as $region)
                            <option value="{{ $region->ro_id }}" @selected($division->regional_office_id == $region->ro_id)>
                                {{ $region->ro_office }}
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
