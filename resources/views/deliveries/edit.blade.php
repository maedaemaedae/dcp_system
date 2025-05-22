<div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-lg p-6 relative animate-fade-in-up">

    

        <h2 class="text-xl text-[#033372] font-semibold mb-4">Edit Deliveries</h2>

       <!-- Close Button -->
        <button onclick="closeModal('editModal')"
             class="absolute top-3 right-3 text-gray-400 text-2xl hover:text-[#4A90E2] transition">
        &times;
        </button>


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
                <textarea id="edit_remarks" name="remarks" rows="3" class="w-full border border-gray-300 rounded-lg px-3 py-2 resize-none"></textarea>
            </div>

            <div class="flex justify-end space-x-2">
                <button type="button" onclick="closeModal('editModal')" class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">Cancel</button>
                <button type="submit" class="text-white px-4 py-2 rounded-md transition" style="background-color: #4A90E2;" onmouseover="this.style.backgroundColor='#3a78c2'" onmouseout="this.style.backgroundColor='#4A90E2'"> 
                    Update
            </div>
        </form>
    </div>
</div>
