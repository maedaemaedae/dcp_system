<!-- Printer Edit Modal -->
<div id="editPrinterModal-{{ $printer->id }}" 
     class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-lg w-full max-w-3xl p-6">
        <h2 class="text-xl font-bold mb-4">Edit Printer</h2>

        <form method="POST" action="{{ route('ict-equipment.update', ['category' => 'printer', 'id' => $printer->id]) }}">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-2 gap-4">
                <!-- Equipment ID -->
                <div>
                    <label class="block text-sm font-medium">Equipment ID</label>
                    <input type="text" name="equipment_id" value="{{ $printer->equipment_id }}" class="w-full border rounded p-2">
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-sm font-medium">Description</label>
                    <input type="text" name="item_description" value="{{ $printer->item_description }}" class="w-full border rounded p-2">
                </div>

                <!-- Brand -->
                <div>
                    <label class="block text-sm font-medium">Brand</label>
                    <input type="text" name="brand" value="{{ $printer->brand }}" class="w-full border rounded p-2">
                </div>

                <!-- Model -->
                <div>
                    <label class="block text-sm font-medium">Model</label>
                    <input type="text" name="model" value="{{ $printer->model }}" class="w-full border rounded p-2">
                </div>

                <!-- Network IP -->
                <div>
                    <label class="block text-sm font-medium">Network IP</label>
                    <input type="text" name="network_ip" value="{{ $printer->network_ip }}" class="w-full border rounded p-2">
                </div>

                <!-- Asset # -->
                <div>
                    <label class="block text-sm font-medium">Asset #</label>
                    <input type="text" name="asset_number" value="{{ $printer->asset_number }}" class="w-full border rounded p-2">
                </div>

                <!-- Serial # -->
                <div>
                    <label class="block text-sm font-medium">Serial #</label>
                    <input type="text" name="serial_number" value="{{ $printer->serial_number }}" class="w-full border rounded p-2">
                </div>

                <!-- Location -->
                <div>
                    <label class="block text-sm font-medium">Location</label>
                    <input type="text" name="location" value="{{ $printer->location }}" class="w-full border rounded p-2">
                </div>

                <!-- Assigned To -->
                <div>
                    <label class="block text-sm font-medium">Assigned To</label>
                    <input type="text" name="assigned_to" value="{{ $printer->assigned_to }}" class="w-full border rounded p-2">
                </div>

                <!-- Purchase Date -->
                <div>
                    <label class="block text-sm font-medium">Purchase Date</label>
                    <input type="date" name="purchase_date" value="{{ $printer->purchase_date->format('Y-m-d') }}" class="w-full border rounded p-2">
                </div>

                <!-- Warranty Expiry -->
                <div>
                    <label class="block text-sm font-medium">Warranty Expiry</label>
                    <input type="date" name="warranty_expiry" value="{{ $printer->warranty_expiry->format('Y-m-d') }}" class="w-full border rounded p-2">
                </div>

                <!-- Condition -->
                <select name="condition" class="border rounded p-2 w-full">
                <option value="IN USE" {{ $printer->condition == 'IN USE' ? 'selected' : '' }}>IN USE</option>
                <option value="FOR REPAIR" {{ $printer->condition == 'FOR REPAIR' ? 'selected' : '' }}>FOR REPAIR</option>
            </select>

                <!-- Note -->
                <div class="col-span-2">
                    <label class="block text-sm font-medium">Note</label>
                    <textarea name="note" rows="3" class="w-full border rounded p-2">{{ $printer->note }}</textarea>
                </div>
            </div>

            <div class="flex justify-end gap-3 mt-6">
                <button type="button" data-modal-close="editPrinterModal-{{ $printer->id }}" 
                        class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400">Cancel</button>
                <button type="submit" class="px-4 py-2 rounded bg-green-600 text-white hover:bg-green-700">Save</button>
            </div>
        </form>
    </div>
</div>