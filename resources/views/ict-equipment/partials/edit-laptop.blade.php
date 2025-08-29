<div id="editLaptopModal-{{ $laptop->id }}" 
     class="fixed inset-0 z-50 hidden overflow-y-auto">
  <div class="flex items-center justify-center min-h-screen p-4">
    <div class="relative bg-white rounded-2xl shadow-xl max-w-4xl w-full p-6">
      <!-- Header -->
      <div class="flex justify-between items-center border-b pb-3 mb-4">
        <h2 class="text-xl font-semibold">Edit Laptop</h2>
        <button type="button" data-modal-close="editLaptopModal-{{ $laptop->id }}">✕</button>
      </div>

      <!-- Form -->
      <form method="POST" action="{{ route('ict-equipment.update', ['category' => 'laptop', 'id' => $laptop->id]) }}">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <input type="text" name="equipment_id" value="{{ $laptop->equipment_id }}" class="border p-2 rounded w-full" required>
          <input type="text" name="item_description" value="{{ $laptop->item_description }}" class="border p-2 rounded w-full" required>
          <input type="text" name="brand" value="{{ $laptop->brand }}" class="border p-2 rounded w-full" required>
          <input type="text" name="model" value="{{ $laptop->model }}" class="border p-2 rounded w-full" required>
          <input type="text" name="asset_number" value="{{ $laptop->asset_number }}" class="border p-2 rounded w-full" required>
          <input type="text" name="serial_number" value="{{ $laptop->serial_number }}" class="border p-2 rounded w-full" required>
          <input type="text" name="location" value="{{ $laptop->location }}" class="border p-2 rounded w-full" required>
          <input type="text" name="assigned_to" value="{{ $laptop->assigned_to }}" class="border p-2 rounded w-full" required>
          <input type="date" name="purchase_date" value="{{ $laptop->purchase_date->format('Y-m-d') }}" class="border p-2 rounded w-full" required>
          <input type="date" name="warranty_expiry" value="{{ $laptop->warranty_expiry->format('Y-m-d') }}" class="border p-2 rounded w-full" required>
        </div>

        <!-- Status -->
        <div class="mt-4">
          <label>Status</label>
          <select name="condition" class="border rounded p-2 w-full">
            <option value="IN USE" {{ $laptop->condition == 'IN USE' ? 'selected' : '' }}>IN USE</option>
            <option value="FOR REPAIR" {{ $laptop->condition == 'FOR REPAIR' ? 'selected' : '' }}>FOR REPAIR</option>
          </select>
        </div>

        <!-- Notes -->
        <div class="mt-4">
          <textarea name="note" class="border rounded p-2 w-full h-20" placeholder="Notes">{{ $laptop->note }}</textarea>
        </div>

        <!-- Footer -->
        <div class="flex justify-end mt-6 gap-3">
          <button type="button" data-modal-close="editLaptopModal-{{ $laptop->id }}" class="px-4 py-2 bg-gray-200 rounded">Cancel</button>
          <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>