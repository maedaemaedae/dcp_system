<!-- Desktop Edit Modal -->
<div id="editDesktopModal-{{ $desktop->id }}" 
     class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-lg w-full max-w-4xl p-6">
        <h2 class="text-xl font-bold mb-4">Edit Desktop</h2>

        <form method="POST" action="{{ route('ict-equipment.update', ['category' => 'desktop', 'id' => $desktop->id]) }}">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-2 gap-4">
                <!-- Equipment ID -->
                <div>
                    <label class="block text-sm font-medium">Equipment ID</label>
                    <input type="text" name="equipment_id" value="{{ $desktop->equipment_id }}" class="w-full border rounded p-2">
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-sm font-medium">Description</label>
                    <input type="text" name="item_description" value="{{ $desktop->item_description }}" class="w-full border rounded p-2">
                </div>

                <!-- PC Make -->
                <div>
                    <label class="block text-sm font-medium">PC Make</label>
                    <input type="text" name="pc_make" value="{{ $desktop->pc_make }}" class="w-full border rounded p-2">
                </div>

                <!-- PC Model -->
                <div>
                    <label class="block text-sm font-medium">PC Model</label>
                    <input type="text" name="pc_model" value="{{ $desktop->pc_model }}" class="w-full border rounded p-2">
                </div>

                <!-- Asset # -->
                <div>
                    <label class="block text-sm font-medium">Asset #</label>
                    <input type="text" name="asset_number" value="{{ $desktop->asset_number }}" class="w-full border rounded p-2">
                </div>

                <!-- PC Serial # -->
                <div>
                    <label class="block text-sm font-medium">PC Serial #</label>
                    <input type="text" name="pc_sn" value="{{ $desktop->pc_sn }}" class="w-full border rounded p-2">
                </div>

                <!-- Monitor SN -->
                <div>
                    <label class="block text-sm font-medium">Monitor SN</label>
                    <input type="text" name="monitor_sn" value="{{ $desktop->monitor_sn }}" class="w-full border rounded p-2">
                </div>

                <!-- AVR SN -->
                <div>
                    <label class="block text-sm font-medium">AVR SN</label>
                    <input type="text" name="avr_sn" value="{{ $desktop->avr_sn }}" class="w-full border rounded p-2">
                </div>

                <!-- WiFi Adapter SN -->
                <div>
                    <label class="block text-sm font-medium">WiFi Adapter SN</label>
                    <input type="text" name="wifi_adapter_sn" value="{{ $desktop->wifi_adapter_sn }}" class="w-full border rounded p-2">
                </div>

                <!-- Keyboard SN -->
                <div>
                    <label class="block text-sm font-medium">Keyboard SN</label>
                    <input type="text" name="keyboard_sn" value="{{ $desktop->keyboard_sn }}" class="w-full border rounded p-2">
                </div>

                <!-- Mouse SN -->
                <div>
                    <label class="block text-sm font-medium">Mouse SN</label>
                    <input type="text" name="mouse_sn" value="{{ $desktop->mouse_sn }}" class="w-full border rounded p-2">
                </div>

                <!-- Location -->
                <div>
                    <label class="block text-sm font-medium">Location</label>
                    <input type="text" name="location" value="{{ $desktop->location }}" class="w-full border rounded p-2">
                </div>

                <!-- Assigned To -->
                <div>
                    <label class="block text-sm font-medium">Assigned To</label>
                    <input type="text" name="assigned_to" value="{{ $desktop->assigned_to }}" class="w-full border rounded p-2">
                </div>

                <!-- Purchase Date -->
                <div>
                    <label class="block text-sm font-medium">Purchase Date</label>
                    <input type="date" name="purchase_date" value="{{ $desktop->purchase_date->format('Y-m-d') }}" class="w-full border rounded p-2">
                </div>

                <!-- Warranty Expiry -->
                <div>
                    <label class="block text-sm font-medium">Warranty Expiry</label>
                    <input type="date" name="warranty_expiry" value="{{ $desktop->warranty_expiry->format('Y-m-d') }}" class="w-full border rounded p-2">
                </div>

                <!-- Condition -->
                <div>
                <select name="condition" class="border rounded p-2 w-full">
                <option value="IN USE" {{ $desktop->condition == 'IN USE' ? 'selected' : '' }}>IN USE</option>
                <option value="FOR REPAIR" {{ $desktop->condition == 'FOR REPAIR' ? 'selected' : '' }}>FOR REPAIR</option>
            </select>
                </div>

                <!-- Note -->
                <div class="col-span-2">
                    <label class="block text-sm font-medium">Note</label>
                    <textarea name="note" rows="3" class="w-full border rounded p-2">{{ $desktop->note }}</textarea>
                </div>
            </div>

            <div class="flex justify-end gap-3 mt-6">
                <button type="button" data-modal-close="editDesktopModal-{{ $desktop->id }}" 
                        class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400">Cancel</button>
                <button type="submit" class="px-4 py-2 rounded bg-green-600 text-white hover:bg-green-700">Save</button>
            </div>
        </form>
    </div>
</div>
<!-- End Desktop Modal -->