<!-- Edit School Modal -->
<div id="editModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
    <div class="bg-white p-6 rounded-lg w-full max-w-2xl relative">
        <button onclick="closeModal('editModal')" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">✖</button>

        <h2 class="text-xl font-semibold mb-4">Edit School</h2>

        <form method="POST" id="editSchoolForm" class="space-y-4">
            @csrf
            @method('PUT')
            <input type="hidden" id="edit_division_id" name="division_id">
            <input type="hidden" id="edit_municipality_id" name="municipality_id">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-medium">School ID</label>
                    <input type="text" id="edit_school_id" name="school_id" class="w-full border rounded px-3 py-2 bg-gray-100" readonly>
                </div>

                <div>
                    <label class="block font-medium">School Name</label>
                    <input type="text" id="edit_school_name" name="school_name" class="w-full border rounded px-3 py-2" required>
                </div>

                <div>
                    <label class="block font-medium">School Address</label>
                    <input type="text" id="edit_school_address" name="school_address" class="w-full border rounded px-3 py-2" required>
                </div>

                <div>
                    <label class="block font-medium">School Head</label>
                    <input type="text" id="edit_school_head" name="school_head" class="w-full border rounded px-3 py-2" required>
                </div>

                <div>
                    <label class="block font-medium">Level</label>
                    <select id="edit_level" name="level" class="w-full border rounded px-3 py-2" required>
                        <option value="">Select Level</option>
                        <option value="Elementary">Elementary</option>
                        <option value="High School">High School</option>
                    </select>
                </div>
            </div>
            
             <!-- Internet Section -->
                <h3 class="text-lg font-semibold mt-4">Internet Information</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-medium">Connected to Internet</label>
                        <select id="edit_connected_to_internet" name="connected_to_internet" class="w-full border rounded px-3 py-2">
                            <option value="">-- Select --</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                    <div>
                        <label class="block font-medium">ISP</label>
                        <input type="text" id="edit_isp" name="isp" class="w-full border rounded px-3 py-2">
                    </div>
                    <div>
                        <label class="block font-medium">Type of ISP</label>
                        <input type="text" id="edit_type_of_isp" name="type_of_isp" class="w-full border rounded px-3 py-2">
                    </div>
                    <div>
                        <label class="block font-medium">Fund Source</label>
                        <input type="text" id="edit_fund_source" name="fund_source" class="w-full border rounded px-3 py-2">
                    </div>
                </div>

                <!-- Electricity Section -->
                <h3 class="text-lg font-semibold mt-4">Electricity Information</h3>

                <div class="mb-4">
                    <label class="block font-medium">Electricity Source</label>
                    <input type="text" id="edit_electricity_source" name="electricity_source" class="w-full border rounded px-3 py-2">
                </div>

            <div class="text-right mt-6">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Update School
                </button>
            </div>
        </form>
    </div>
</div>
