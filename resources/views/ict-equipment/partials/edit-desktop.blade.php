<!-- 🖥️ Desktop Edit Modal -->
<div id="editDesktopModal-{{ $desktop->id }}" 
     class="fixed inset-0 bg-black/50 hidden z-50 flex items-center justify-center backdrop-blur-sm">

  <!-- Modal Content -->
  <div class="bg-white rounded-2xl shadow-2xl w-full max-w-4xl max-h-[90vh] flex flex-col relative overflow-hidden animate-fadeIn">
    
    <!-- 🔹 Header -->
    <div class="sticky top-0 z-10 flex justify-between items-center px-8 py-5 border-b bg-white rounded-t-2xl">
      <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
        <i class="fa-solid fa-desktop text-[#4A90E2]"></i> Edit Desktop
      </h2>
      <button type="button" data-modal-close="editDesktopModal-{{ $desktop->id }}"
              class="text-gray-400 hover:text-gray-600 transition text-xl">
        ✕
      </button>
    </div>

    <!-- 🔹 Form -->
    <div class="p-6 overflow-y-auto">
    <form method="POST" action="{{ route('ict-equipment.update', ['category' => 'desktop', 'id' => $desktop->id]) }}">
      @csrf
      @method('PUT')

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Equipment ID -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-2">Equipment ID</label>
          <input type="text" name="equipment_id" value="{{ $desktop->equipment_id }}" class="w-full border rounded-lg p-2">
        </div>

        <!-- Description -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
          <input type="text" name="item_description" value="{{ $desktop->item_description }}" class="w-full border rounded-lg p-2">
        </div>

        <!-- PC Make -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-2">PC Make</label>
          <input type="text" name="pc_make" value="{{ $desktop->pc_make }}" class="w-full border rounded-lg p-2">
        </div>

        <!-- PC Model -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-2">PC Model</label>
          <input type="text" name="pc_model" value="{{ $desktop->pc_model }}" class="w-full border rounded-lg p-2">
        </div>

        <!-- Asset # -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-2">Asset #</label>
          <input type="text" name="asset_number" value="{{ $desktop->asset_number }}" class="w-full border rounded-lg p-2">
        </div>

        <!-- PC Serial # -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-2">PC Serial #</label>
          <input type="text" name="pc_sn" value="{{ $desktop->pc_sn }}" class="w-full border rounded-lg p-2">
        </div>

        <!-- Monitor SN -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-2">Monitor SN</label>
          <input type="text" name="monitor_sn" value="{{ $desktop->monitor_sn }}" class="w-full border rounded-lg p-2">
        </div>

        <!-- AVR SN -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-2">AVR SN</label>
          <input type="text" name="avr_sn" value="{{ $desktop->avr_sn }}" class="w-full border rounded-lg p-2">
        </div>

        <!-- WiFi Adapter SN -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-2">WiFi Adapter SN</label>
          <input type="text" name="wifi_adapter_sn" value="{{ $desktop->wifi_adapter_sn }}" class="w-full border rounded-lg p-2">
        </div>

        <!-- Keyboard SN -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-2">Keyboard SN</label>
          <input type="text" name="keyboard_sn" value="{{ $desktop->keyboard_sn }}" class="w-full border rounded-lg p-2">
        </div>

        <!-- Mouse SN -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-2">Mouse SN</label>
          <input type="text" name="mouse_sn" value="{{ $desktop->mouse_sn }}" class="w-full border rounded-lg p-2">
        </div>

        <!-- Location -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-2">Location</label>
          <input type="text" name="location" value="{{ $desktop->location }}" class="w-full border rounded-lg p-2">
        </div>

        <!-- Assigned To -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-2">Assigned To</label>
          <input type="text" name="assigned_to" value="{{ $desktop->assigned_to }}" class="w-full border rounded-lg p-2">
        </div>

        <!-- Purchase Date -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-2">Purchase Date</label>
          <input type="date" name="purchase_date" value="{{ $desktop->purchase_date->format('Y-m-d') }}" class="w-full border rounded-lg p-2">
        </div>

        <!-- Warranty Expiry -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-2">Warranty Expiry</label>
          <input type="date" name="warranty_expiry" value="{{ $desktop->warranty_expiry->format('Y-m-d') }}" class="w-full border rounded-lg p-2">
        </div>

        <!-- Condition -->
        <div>
          <label class="block text-sm font-medium text-gray-700 mb-2">Condition</label>
          <select name="condition" class="border rounded-lg p-2 w-full">
            <option value="IN USE" {{ $desktop->condition == 'IN USE' ? 'selected' : '' }}>IN USE</option>
            <option value="FOR REPAIR" {{ $desktop->condition == 'FOR REPAIR' ? 'selected' : '' }}>FOR REPAIR</option>
          </select>
        </div>

        <!-- Note -->
        <div class="col-span-2">
          <label class="block text-sm font-medium text-gray-700 mb-2">Note</label>
          <textarea name="note" rows="3" class="w-full border rounded-lg p-2">{{ $desktop->note }}</textarea>
        </div>
      </div>

      <!-- 🔹 Footer -->
      <div class="flex justify-end gap-3 mt-6 border-t pt-4">
          <button type="button" data-modal-close="editLaptopModal-{{ $desktop->id }}" 
                  class="px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300 text-gray-700 transition">
            Cancel
          </button>
          <button type="submit" 
                  class="px-4 py-2 rounded-lg bg-[#4A90E2] hover:bg-[#3a78bf] text-white font-medium shadow transition">
            Save
          </button>
        </div>
    </form>
  </div>
</div>
