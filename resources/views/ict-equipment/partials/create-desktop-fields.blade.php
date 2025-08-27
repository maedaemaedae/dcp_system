<!-- Desktop Form -->
<form action="{{ route('ict-equipment.store') }}" method="POST" class="space-y-6">
    @csrf
    <input type="hidden" name="category" value="desktop">

    <!-- Equipment Identification -->
    <div class="p-4 bg-gray-50 rounded-xl shadow-sm">
        <h3 class="font-semibold text-gray-700 mb-3 flex items-center gap-2">
            <i class="fa-solid fa-desktop text-purple-500"></i> Desktop Equipment Details
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <input type="text" name="equipment_id" placeholder="Equipment ID" class="border rounded-lg p-2 w-full" required>
            <input type="text" name="item_description" placeholder="Description" class="border rounded-lg p-2 w-full" required>
        </div>
    </div>

    <!-- Desktop Specifications -->
    <div class="p-4 bg-gray-50 rounded-xl shadow-sm">
        <h3 class="font-semibold text-gray-700 mb-3 flex items-center gap-2">
            <i class="fa-solid fa-microchip text-purple-500"></i> PC Specifications
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <input type="text" name="pc_make" placeholder="PC Make" class="border rounded-lg p-2 w-full" required>
            <input type="text" name="pc_model" placeholder="PC Model" class="border rounded-lg p-2 w-full" required>
        </div>
    </div>

    <!-- Asset & Serial Numbers -->
    <div class="p-4 bg-gray-50 rounded-xl shadow-sm">
        <h3 class="font-semibold text-gray-700 mb-3 flex items-center gap-2">
            <i class="fa-solid fa-barcode text-blue-500"></i> Asset & Serial Numbers
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <input type="text" name="asset_number" placeholder="Asset #" class="border rounded-lg p-2 w-full" required>
            <input type="text" name="pc_sn" placeholder="PC Serial #" class="border rounded-lg p-2 w-full" required>
            <input type="text" name="monitor_sn" placeholder="Monitor Serial #" class="border rounded-lg p-2 w-full" required>
            <input type="text" name="avr_sn" placeholder="AVR Serial #" class="border rounded-lg p-2 w-full">
            <input type="text" name="wifi_adapter_sn" placeholder="WiFi Adapter Serial #" class="border rounded-lg p-2 w-full">
            <input type="text" name="keyboard_sn" placeholder="Keyboard Serial #" class="border rounded-lg p-2 w-full">
            <input type="text" name="mouse_sn" placeholder="Mouse Serial #" class="border rounded-lg p-2 w-full">
        </div>
    </div>

    <!-- Assignment & Location -->
    <div class="p-4 bg-gray-50 rounded-xl shadow-sm">
        <h3 class="font-semibold text-gray-700 mb-3 flex items-center gap-2">
            <i class="fa-solid fa-location-dot text-red-500"></i> Assignment & Location
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <input type="text" name="location" placeholder="Location" class="border rounded-lg p-2 w-full" required>
            <input type="text" name="assigned_to" placeholder="Assigned To" class="border rounded-lg p-2 w-full" required>
        </div>
    </div>

    <!-- Purchase & Warranty -->
    <div class="p-4 bg-gray-50 rounded-xl shadow-sm">
        <h3 class="font-semibold text-gray-700 mb-3 flex items-center gap-2">
            <i class="fa-solid fa-receipt text-green-500"></i> Purchase & Warranty
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <input type="date" name="purchase_date" class="border rounded-lg p-2 w-full" required>
            <input type="date" name="warranty_expiry" class="border rounded-lg p-2 w-full" required>
        </div>
    </div>

    <!-- Status -->
    <div class="p-4 bg-gray-50 rounded-xl shadow-sm">
        <h3 class="font-semibold text-gray-700 mb-3 flex items-center gap-2">
            <i class="fa-solid fa-chart-line text-orange-500"></i> Status
        </h3>
        <select name="condition" class="border rounded-lg p-2 w-full" required>
            <option value="IN USE">IN USE</option>
            <option value="FOR REPAIR">FOR REPAIR</option>
        </select>
    </div>

    <!-- Notes -->
    <div class="p-4 bg-gray-50 rounded-xl shadow-sm">
        <h3 class="font-semibold text-gray-700 mb-3 flex items-center gap-2">
            <i class="fa-solid fa-pen text-gray-500"></i> Notes (Optional)
        </h3>
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
