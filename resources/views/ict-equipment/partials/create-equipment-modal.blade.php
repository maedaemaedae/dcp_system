
        <!-- Body (Scrollable if needed) -->
        <form action="{{ route('ict-equipment.store') }}" method="POST" class="overflow-y-auto px-6 py-6 space-y-6">
            @csrf

            <!-- Equipment Identification -->
            <div class="p-4 bg-gray-50 rounded-xl shadow-sm">
                <h3 class="font-semibold text-gray-700 mb-3">🔑 Equipment Identification</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input type="text" name="equipment_id" placeholder="Equipment ID" class="border rounded-lg p-2 w-full" required>
                    <input type="text" name="item_description" placeholder="Description" class="border rounded-lg p-2 w-full" required>
                    <input type="text" name="category" placeholder="Category" class="border rounded-lg p-2 w-full" required>
                    <input type="text" name="brand" placeholder="Brand" class="border rounded-lg p-2 w-full" required>
                    <input type="text" name="model" placeholder="Model" class="border rounded-lg p-2 w-full md:col-span-2" required>
                </div>
            </div>

            <!-- Asset Details -->
            <div class="p-4 bg-gray-50 rounded-xl shadow-sm">
                <h3 class="font-semibold text-gray-700 mb-3">📦 Asset Details</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input type="text" name="asset_number" placeholder="Asset #" class="border rounded-lg p-2 w-full" required>
                    <input type="text" name="serial_number" placeholder="Serial #" class="border rounded-lg p-2 w-full" required>
                </div>
            </div>

            <!-- Assignment & Location -->
            <div class="p-4 bg-gray-50 rounded-xl shadow-sm">
                <h3 class="font-semibold text-gray-700 mb-3">📍 Assignment & Location</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input type="text" name="location" placeholder="Location" class="border rounded-lg p-2 w-full" required>
                    <input type="text" name="assigned_to" placeholder="Assigned To" class="border rounded-lg p-2 w-full" required>
                </div>
            </div>

            <!-- Purchase & Warranty -->
            <div class="p-4 bg-gray-50 rounded-xl shadow-sm">
                <h3 class="font-semibold text-gray-700 mb-3">🧾 Purchase & Warranty</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input type="date" name="purchase_date" class="border rounded-lg p-2 w-full" required>
                    <input type="date" name="warranty_expiry" class="border rounded-lg p-2 w-full" required>
                </div>
            </div>

            <!-- Status -->
            <div class="p-4 bg-gray-50 rounded-xl shadow-sm">
                <h3 class="font-semibold text-gray-700 mb-3">📊 Status</h3>
                <select name="condition" class="border rounded-lg p-2 w-full" required>
                    <option value="IN USE">IN USE</option>
                    <option value="FOR REPAIR">FOR REPAIR</option>
                </select>
            </div>

            <!-- Notes -->
            <div class="p-4 bg-gray-50 rounded-xl shadow-sm">
                <h3 class="font-semibold text-gray-700 mb-3">📝 Notes (Optional)</h3>
                <textarea name="note" placeholder="Additional notes..." class="border rounded-lg p-2 w-full h-20 resize-none"></textarea>
            </div>

            <!-- Actions -->
            <div class="flex justify-end items-center gap-3 pt-4 border-t">
                <button type="button" id="cancelModalBtn" 
                    class="px-5 py-2.5 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-lg transition">
                    Cancel
                </button>
                <button type="submit" 
                    class="px-6 py-2.5 bg-[#2D9CDB] hover:bg-[#2384ba] text-white font-semibold rounded-lg shadow-md transition">
                    Save
                </button>
            </div>
        </form>