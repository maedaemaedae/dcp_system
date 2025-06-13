<!-- Edit Recipient Modal -->
<div id="editRecipientModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center">
    <div class="bg-white w-full max-w-xl rounded-2xl shadow-xl p-8 relative animate-fadeInUp font-['Poppins']">
        
        <!-- Close Button -->
        <button onclick="closeModal('editRecipientModal')"
            class="absolute top-4 right-4 text-gray-400 hover:text-gray-700 text-2xl transition duration-200">
            &times;
        </button>

        <!-- Header -->
        <h2 class="text-2xl font-semibold text-gray-800 mb-6 flex items-center gap-2">
            📥 <span>Edit Recipient</span>
        </h2>

        <!-- Form -->
        <form id="editRecipientForm" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="edit_contact_person" class="block text-sm font-medium text-gray-700 mb-1">Contact Person</label>
                <input type="text" name="contact_person" id="edit_contact_person"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-white shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div>
                <label for="edit_position" class="block text-sm font-medium text-gray-700 mb-1">Position</label>
                <input type="text" name="position" id="edit_position"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-white shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="edit_contact_number" class="block text-sm font-medium text-gray-700 mb-1">Contact Number</label>
                <input type="text" name="contact_number" id="edit_contact_number"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-white shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label for="edit_quantity" class="block text-sm font-medium text-gray-700 mb-1">Quantity</label>
                <input type="number" name="quantity" id="edit_quantity" min="1"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-white shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Actions -->
            <div class="flex justify-end gap-3 pt-4">
                <button type="button" onclick="closeModal('editRecipientModal')"
                    class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg font-medium hover:bg-gray-300 transition">
                    Cancel
                </button>
                <button type="submit"
                    class="px-4 py-2 bg-[#F59E0B] text-white rounded-lg font-medium hover:bg-[#D97706] transition">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>
