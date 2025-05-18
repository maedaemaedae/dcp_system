<div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-lg p-6 relative animate-fade-in-up">
        <h3 class="text-2xl font-bold text-gray-800 mb-4">✏️ Edit Delivery</h3>

        <form method="POST" id="editDeliveryForm">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Delivery</label>
                <select id="edit_delivery" name="delivery_id" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                    @foreach ($deliveries as $delivery)
                        <option value="{{ $delivery->id }}">{{ $delivery->name ?? 'Delivery #' . $delivery->id }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select id="edit_status" name="status" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                    <option value="Pending">Pending</option>
                    <option value="Delivered">Delivered</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Delivery Date</label>
                <input type="date" id="edit_delivery_date" name="delivery_date" class="w-full border border-gray-300 rounded-lg px-3 py-2">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Arrival Date</label>
                <input type="date" id="edit_arrival_date" name="arrival_date" class="w-full border border-gray-300 rounded-lg px-3 py-2">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Remarks</label>
                <textarea id="edit_remarks" name="remarks" rows="3" class="w-full border border-gray-300 rounded-lg px-3 py-2"></textarea>
            </div>

            <div class="flex justify-end space-x-2">
                <button type="button" onclick="closeModal('editModal')" class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Update</button>
            </div>
        </form>
    </div>
</div>
