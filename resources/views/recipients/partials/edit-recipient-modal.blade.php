<div id="editRecipientModal" class="fixed inset-0 hidden bg-black bg-opacity-50 z-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded shadow-lg w-full max-w-xl">
        <h2 class="text-xl font-semibold mb-4">Edit Recipient</h2>
        <form id="editRecipientForm" method="POST">
            @csrf
            @method('PUT')

            <label>Contact Person</label>
            <input type="text" name="contact_person" id="edit_contact_person" class="w-full border rounded mb-3" required>

            <label>Position</label>
            <input type="text" name="position" id="edit_position" class="w-full border rounded mb-3">

            <label>Contact Number</label>
            <input type="text" name="contact_number" id="edit_contact_number" class="w-full border rounded mb-3">

            <label>Quantity</label>
            <input type="number" name="quantity" id="edit_quantity" class="w-full border rounded mb-3" min="1" required>

            <div class="flex justify-end gap-4 mt-4">
                <button type="button" onclick="closeModal('editRecipientModal')" class="px-4 py-2 bg-gray-500 text-white rounded">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Update</button>
            </div>
        </form>
    </div>
</div>
