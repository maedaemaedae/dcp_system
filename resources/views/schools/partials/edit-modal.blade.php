<!-- Edit School Modal -->
<div id="editModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
    <div class="bg-white p-6 rounded-2xl w-full max-w-2xl relative">

        <button onclick="closeModal('editModal')" class="absolute top-3 right-4 text-gray-400 hover:text-gray-600 text-2xl transition-colors duration-200">
            &times;
        </button>

        <h2 class="text-xl text-[#033372] font-semibold mb-4">Edit School</h2>

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

            <div class="text-right mt-6">
                <button type="submit" class="text-white px-4 py-2 rounded-md transition" style="background-color: #4A90E2;" onmouseover="this.style.backgroundColor='#3a78c2'" onmouseout="this.style.backgroundColor='#4A90E2'">
                    Update School
                </button>
            </div>
        </form>
    </div>
</div>
