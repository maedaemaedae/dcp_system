
    <!-- resources/views/regionaloffices/partials/edit-modal.blade.php -->
<div id="editModal-{{ $ro->ro_id }}" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-lg relative">
        <h3 class="text-lg font-semibold mb-4">Edit Regional Office</h3>
        <form action="{{ route('regional-offices.update', $ro->ro_id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-medium mb-2">Office</label>
                <input type="text" name="ro_office" value="{{ $ro->ro_office }}" class="w-full border border-gray-300 px-3 py-2 rounded" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-medium mb-2">Person in Charge</label>
                <input type="text" name="person_in_charge" value="{{ $ro->person_in_charge }}" class="w-full border border-gray-300 px-3 py-2 rounded" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-medium mb-2">Email</label>
                <input type="email" name="email" value="{{ $ro->email }}" class="w-full border border-gray-300 px-3 py-2 rounded" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-medium mb-2">Contact No.</label>
                <input type="text" name="contact_no" value="{{ $ro->contact_no }}" class="w-full border border-gray-300 px-3 py-2 rounded" required>
            </div>

            <div class="flex justify-end space-x-2">
                <button type="button" onclick="closeEditModal({{ $ro->ro_id }})" class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Save</button>
            </div>
        </form>
    </div>
</div>


    <!-- Add your JS links here, if any (e.g., Alpine.js) -->
</body>
</html>
