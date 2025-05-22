<div id="addModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
            <div class="bg-white p-6 rounded-lg shadow-lg w-[500px]">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Add Division Office</h3>
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
                    <div class="mt-6 text-right">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Save</button>
                        <button type="button" id="closeAddModalBtn" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700 ml-2">Cancel</button>
                    </div>
                </form>
            </div>
        </div>