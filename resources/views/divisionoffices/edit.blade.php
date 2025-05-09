<!-- Edit Division Office Modal -->
<div id="editModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg w-[500px]">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">Edit Division Office</h3>
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
                            <option value="{{ $region->ro_id }}" @if ($division->regional_office_id == $region->ro_id) selected @endif>
                                {{ $region->ro_office }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mt-6 text-right">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
                <button type="button" id="closeEditModalBtn" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700 ml-2">Cancel</button>
            </div>
        </form>
    </div>
</div>

<!-- Trigger Button to Open Modal -->
<button id="openEditModalBtn" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Edit Division Office</button>