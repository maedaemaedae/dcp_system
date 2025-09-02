<!-- 📌 Printer Edit Modal -->
<div id="editPrinterModal-{{ $printer->id }}" 
     class="fixed inset-0 bg-black/50 hidden z-50 flex items-center justify-center backdrop-blur-sm">
    
    <!-- Modal Content -->
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-3xl max-h-[90vh] flex flex-col relative overflow-hidden animate-fadeIn">
        
        <!-- 🔹 Header -->
        <div class="sticky top-0 z-10 flex justify-between items-center px-6 py-4 border-b bg-white rounded-t-2xl">
            <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                <i class="fa-solid fa-print text-[#4A90E2]"></i> Edit Printer
            </h2>
            <button type="button" data-modal-close="editPrinterModal-{{ $printer->id }}"
                    class="text-gray-400 hover:text-gray-600 transition text-xl">
                ✕
            </button>
        </div>

        <!-- 🔹 Body -->
        <div class="p-6 overflow-y-auto">
            <form method="POST" action="{{ route('ict-equipment.update', ['category' => 'printer', 'id' => $printer->id]) }}">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-2 gap-4">
                    <!-- Equipment ID -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Equipment ID</label>
                        <input type="text" name="equipment_id" value="{{ $printer->equipment_id }}" 
                               class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-[#4A90E2] focus:outline-none">
                    </div>

                    <!-- Description -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Description</label>
                        <input type="text" name="item_description" value="{{ $printer->item_description }}" 
                               class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-[#4A90E2] focus:outline-none">
                    </div>

                    <!-- Brand -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Brand</label>
                        <input type="text" name="brand" value="{{ $printer->brand }}" 
                               class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-[#4A90E2] focus:outline-none">
                    </div>

                    <!-- Model -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Model</label>
                        <input type="text" name="model" value="{{ $printer->model }}" 
                               class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-[#4A90E2] focus:outline-none">
                    </div>

                    <!-- Network IP -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Network IP</label>
                        <input type="text" name="network_ip" value="{{ $printer->network_ip }}" 
                               class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-[#4A90E2] focus:outline-none">
                    </div>

                    <!-- Asset # -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Asset #</label>
                        <input type="text" name="asset_number" value="{{ $printer->asset_number }}" 
                               class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-[#4A90E2] focus:outline-none">
                    </div>

                    <!-- Serial # -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Serial #</label>
                        <input type="text" name="serial_number" value="{{ $printer->serial_number }}" 
                               class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-[#4A90E2] focus:outline-none">
                    </div>

                    <!-- Location -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Location</label>
                        <input type="text" name="location" value="{{ $printer->location }}" 
                               class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-[#4A90E2] focus:outline-none">
                    </div>

                    <!-- Assigned To -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Assigned To</label>
                        <input type="text" name="assigned_to" value="{{ $printer->assigned_to }}" 
                               class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-[#4A90E2] focus:outline-none">
                    </div>

                    <!-- Purchase Date -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Purchase Date</label>
                        <input type="date" name="purchase_date" value="{{ $printer->purchase_date->format('Y-m-d') }}" 
                               class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-[#4A90E2] focus:outline-none">
                    </div>

                    <!-- Warranty Expiry -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Warranty Expiry</label>
                        <input type="date" name="warranty_expiry" value="{{ $printer->warranty_expiry->format('Y-m-d') }}" 
                               class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-[#4A90E2] focus:outline-none">
                    </div>

                    <!-- Condition -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Condition</label>
                        <select name="condition" 
                                class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-[#4A90E2] focus:outline-none">
                            <option value="IN USE" {{ $printer->condition == 'IN USE' ? 'selected' : '' }}>IN USE</option>
                            <option value="FOR REPAIR" {{ $printer->condition == 'FOR REPAIR' ? 'selected' : '' }}>FOR REPAIR</option>
                        </select>
                    </div>

                    <!-- Note -->
                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Note</label>
                        <textarea name="note" rows="3" 
                                  class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-[#4A90E2] focus:outline-none">{{ $printer->note }}</textarea>
                    </div>
                </div>

                <!-- 🔹 Footer -->
                <div class="flex justify-end gap-3 mt-6 border-t pt-4">
                    <button type="button" data-modal-close="editPrinterModal-{{ $printer->id }}" 
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
</div>
