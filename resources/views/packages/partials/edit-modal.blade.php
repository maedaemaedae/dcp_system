<div id="editModal-{{ $packageType->id }}" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
  <div class="bg-white p-6 rounded-2xl shadow-2xl w-full max-w-2xl relative animate-fade-in-up">
    <!-- Close Button -->
    <button onclick="closeEditModal({{ $packageType->id }})"
            class="absolute top-3 right-3 text-gray-400 text-2xl hover:text-[#4A90E2] transition">
      &times;
    </button>

    <!-- Title -->
    <h2 class="text-xl font-semibold text-[#033372] mb-6">Edit Package</h2>

    <form method="POST" action="{{ route('package-types.update', $packageType->id) }}" class="space-y-6">
      @csrf
      @method('PUT')

      <!-- Package Code -->
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Package Code</label>
        <input name="package_code" type="text" 
               class="w-full rounded-xl border border-gray-300 focus:ring-[#4A90E2] focus:border-[#4A90E2] px-4 py-2 text-sm"
               value="{{ $packageType->package_code }}" required>
      </div>

      <!-- Description -->
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
        <textarea name="description" rows="3"
                  class="w-full rounded-xl border border-gray-300 focus:ring-[#4A90E2] focus:border-[#4A90E2] px-4 py-2 text-sm resize-none">{{ $packageType->description }}</textarea>
      </div>

      <!-- Items Section -->
      <div>
        <h3 class="text-md font-semibold text-gray-800 mb-3">Items</h3>
        <div id="edit-item-container-{{ $packageType->id }}" class="space-y-3">
          @foreach ($packageType->contents as $index => $content)
            <div class="flex gap-3">
              <select name="items[{{ $index }}][item_id]"
                      class="w-2/3 rounded-md border border-gray-300 px-3 py-2 text-sm focus:ring-[#4A90E2] focus:border-[#4A90E2]">
                @foreach ($inventoryItems as $item)
                  <option value="{{ $item->item_id }}" {{ $content->item_id == $item->item_id ? 'selected' : '' }}>
                    {{ $item->item_name }}
                  </option>
                @endforeach
              </select>
              <input type="number" name="items[{{ $index }}][quantity]" min="1"
                     class="w-1/3 rounded-md border border-gray-300 px-3 py-2 text-sm focus:ring-[#4A90E2] focus:border-[#4A90E2]"
                     value="{{ $content->quantity }}">
            </div>
          @endforeach
        </div>

        <div class="mt-3 flex gap-2">
          <button type="button"
                  onclick="addEditItem({{ $packageType->id }})"
                  class="inline-flex items-center gap-2 text-sm font-medium text-[#4A90E2] border border-[#4A90E2] hover:bg-[#4A90E2] hover:text-white px-4 py-2 rounded-md transition-all shadow-sm">
            <i class="fas fa-plus text-xs"></i>
            Add Another Item
          </button>
          <button type="button"
                  onclick="removeLastEditItem({{ $packageType->id }})"
                  class="inline-flex items-center gap-2 text-sm font-medium text-red-500 border border-red-500 hover:bg-red-500 hover:text-white px-4 py-2 rounded-md transition-all shadow-sm">
            <i class="fas fa-trash text-xs"></i>
            Remove Last Item
          </button>
        </div>
      </div>

      <!-- Action Buttons -->
      <div class="flex justify-end gap-2 pt-4">
        <button type="button"
                onclick="closeEditModal({{ $packageType->id }})"
                class="px-5 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium rounded-md transition">
          Cancel
        </button>
        <button type="submit"
                class="bg-[#4A90E2] hover:bg-[#3a78c2] text-white font-medium px-6 py-2 rounded-md transition-all">
          Update Package
        </button>
      </div>
    </form>

    <script>
      let editIndex{{ $packageType->id }} = {{ count($packageType->contents) }};
      function addEditItem(id) {
        const container = document.getElementById(`edit-item-container-${id}`);
        const html = `
          <div class="flex gap-3">
            <select name="items[${editIndex{{ $packageType->id }} }][item_id]"
                    class="w-2/3 rounded-md border border-gray-300 px-3 py-2 text-sm focus:ring-[#4A90E2] focus:border-[#4A90E2]">
              @foreach ($inventoryItems as $item)
                <option value="{{ $item->item_id }}">{{ $item->item_name }}</option>
              @endforeach
            </select>
            <input type="number" name="items[${editIndex{{ $packageType->id }} }][quantity]" min="1"
                   class="w-1/3 rounded-md border border-gray-300 px-3 py-2 text-sm focus:ring-[#4A90E2] focus:border-[#4A90E2]"
                   value="1">
          </div>`;
        container.insertAdjacentHTML('beforeend', html);
        editIndex{{ $packageType->id }}++;
      }

      function removeLastEditItem(id) {
        const container = document.getElementById(`edit-item-container-${id}`);
        if (container.children.length > 1) {
          container.lastElementChild.remove();
          editIndex{{ $packageType->id }}--;
        }
      }
    </script>
  </div>
</div>
