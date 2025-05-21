<!-- Edit School Modal -->
<div id="editSchoolModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-50 hidden justify-center items-center">
    <div class="bg-white w-full max-w-lg rounded-lg shadow-lg p-6 relative">
        <h2 class="text-xl font-semibold mb-4">Edit School</h2>

        <form id="editSchoolForm" method="POST">
            @csrf
            @method('PUT')

            <input type="hidden" name="school_id" id="editSchoolId">

            <div class="mb-3">
                <label class="block text-sm font-medium">School Name</label>
                <input type="text" name="school_name" id="editSchoolName" class="w-full border rounded px-3 py-2">
            </div>

            <div class="mb-3">
                <label class="block text-sm font-medium">School Address</label>
                <input type="text" name="school_address" id="editSchoolAddress" class="w-full border rounded px-3 py-2">
            </div>

            <div class="mb-3">
                <label class="block text-sm font-medium">Division</label>
                <select name="division_id" id="editDivisionId" class="w-full border rounded px-3 py-2">
                    <option value="">Select Division</option>
                    @foreach($divisions as $division)
                        <option value="{{ $division->division_id }}">{{ $division->division_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="block text-sm font-medium">Connected to Internet?</label>
                <select name="has_internet" id="editHasInternet" class="w-full border rounded px-3 py-2">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="block text-sm font-medium">Internet Provider</label>
                <input type="text" name="internet_provider" id="editInternetProvider" class="w-full border rounded px-3 py-2">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Electricity Provider</label>
                <input type="text" name="electricity_provider" id="editElectricityProvider" class="w-full border rounded px-3 py-2">
            </div>

            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeModal('editSchoolModal')" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Update</button>
            </div>
        </form>

        <!-- Close Button -->
        <button class="absolute top-2 right-2 text-gray-500 hover:text-gray-700" onclick="closeModal('editSchoolModal')">&times;</button>
    </div>
</div>
