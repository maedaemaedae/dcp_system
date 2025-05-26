<!-- Create School Modal -->
<div id="createSchoolModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-50 hidden justify-center items-center">
    <div class="bg-white w-full max-w-lg rounded-lg shadow-lg p-6 relative">
        <h2 class="text-xl font-semibold mb-4">Add New School</h2>

        <form id="createSchoolForm" method="POST" action="{{ route('recipients.school.store') }}">
            @csrf

            <div class="mb-3">
                <label class="block text-sm font-medium">Region</label>
                <select name="regional_office_id" class="w-full border rounded px-3 py-2">
                    <option value="">Select Regional Office</option>
                    @foreach($regionalOffices as $ro)
                        <option value="{{ $ro->ro_id }}">{{ $ro->ro_office }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="block text-sm font-medium">School ID</label>
                <input type="number" name="school_id" required class="w-full border rounded px-3 py-2">
            </div>

            <div class="mb-3">
                <label class="block text-sm font-medium">School Name</label>
                <input type="text" name="school_name" required class="w-full border rounded px-3 py-2">
            </div>

            <div class="mb-3">
                <label class="block text-sm font-medium">School Address</label>
                <input type="text" name="school_address" class="w-full border rounded px-3 py-2">
            </div>

            <div class="mb-3">
                <label class="block text-sm font-medium">Division</label>
                <select name="division_id" class="w-full border rounded px-3 py-2" required>
                    <option value="">Select Division</option>
                    @foreach($divisions as $division)
                        <option value="{{ $division->division_id }}">{{ $division->division_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="block text-sm font-medium">Connected to Internet?</label>
                <select name="has_internet" class="w-full border rounded px-3 py-2">
                    <option value="1">Yes</option>
                    <option value="0" selected>No</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="block text-sm font-medium">Internet Provider</label>
                <input type="text" name="internet_provider" class="w-full border rounded px-3 py-2">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Electricity Provider</label>
                <input type="text" name="electricity_provider" class="w-full border rounded px-3 py-2">
            </div>

            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeModal('createSchoolModal')" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Save</button>
            </div>
        </form>

        <!-- Close Button -->
        <button class="absolute top-2 right-2 text-gray-500 hover:text-gray-700" onclick="closeModal('createSchoolModal')">&times;</button>
    </div>
</div>
