<div id="addModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 transition-opacity duration-300">

    <div class="bg-white p-6 rounded-2xl shadow-2xl w-full max-w-2xl relative animate-fade-in-up">
        <!-- Close Button -->
        <button id="closeAddModalBtn"
                class="absolute top-3 right-3 text-gray-400 text-2xl hover:text-[#4A90E2] transition">
      &times;
    </button>

        <!-- Title -->
        <h2 class="text-xl font-semibold text-[#033372] mb-6">Add New Package</h2>

        <form method="POST" action="{{ route('package-types.store') }}" class="space-y-6">
            @csrf

            <!-- Package Code -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Package Code</label>
                <input name="package_code" type="text"
                       class="w-full rounded-xl border border-gray-300 focus:ring-[#4A90E2] focus:border-[#4A90E2] px-4 py-2 text-sm"
                       required>
            </div>

            <!-- Description -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea name="description"
                          class="w-full rounded-xl border border-gray-300 focus:ring-[#4A90E2] focus:border-[#4A90E2] px-4 py-2 text-sm resize-none"
                          rows="3"></textarea>
            </div>

            <!-- Items Section -->
            <div>
                <h3 class="text-md font-semibold text-gray-800 mb-3">Items</h3>
                <div id="add-item-container" class="space-y-3">
                    <div class="flex gap-3">
                        <select name="items[0][item_id]"
                                class="w-2/3 rounded-md border border-gray-300 px-3 py-2 text-sm focus:ring-[#4A90E2] focus:border-[#4A90E2]">
                            @foreach ($inventoryItems as $item)
                                <option value="{{ $item->item_id }}">{{ $item->item_name }}</option>
                            @endforeach
                        </select>
                        <input type="number" name="items[0][quantity]" min="1"
                               class="w-1/3 rounded-md border border-gray-300 px-3 py-2 text-sm focus:ring-[#4A90E2] focus:border-[#4A90E2]"
                               value="1">
                    </div>
                </div>

                <div class="mt-3 flex gap-2">
                <!-- Add Item Button (Secondary Style) -->
                <button type="button"
                        onclick="addNewItem()"
                        class="inline-flex items-center gap-2 text-sm font-medium text-[#4A90E2] border border-[#4A90E2] hover:bg-[#4A90E2] hover:text-white px-4 py-2 rounded-md transition-all shadow-sm">
                    <i class="fas fa-plus text-xs"></i>
                    Add Another Item
                </button>

                <!-- Delete Item Button (Secondary Danger Style) -->
                <button type="button"
                        onclick="removeLastItem()"
                        class="inline-flex items-center gap-2 text-sm font-medium text-red-500 border border-red-500 hover:bg-red-500 hover:text-white px-4 py-2 rounded-md transition-all shadow-sm">
                    <i class="fas fa-trash text-xs"></i>
                    Remove Last Item
                </button>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end gap-2 pt-4">
                <button type="button"
                       onclick="closeAddModal()"
                        class="px-5 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium rounded-md transition">
                    Cancel
                </button>
                <button type="submit"
                        class="bg-[#4A90E2] hover:bg-[#3a78c2] text-white font-medium px-6 py-2 rounded-md transition-all">
                    Save Package
                </button>
            </div>

        </form>

        <script>
    let createIndex = 1;
    function addNewItem() {
        const container = document.getElementById('add-item-container');
        const html = `
            <div class="flex gap-3">
                <select name="items[${createIndex}][item_id]"
                        class="w-2/3 rounded-md border border-gray-300 px-3 py-2 text-sm focus:ring-[#4A90E2] focus:border-[#4A90E2]">
                    @foreach ($inventoryItems as $item)
                        <option value="{{ $item->item_id }}">{{ $item->item_name }}</option>
                    @endforeach
                </select>
                <input type="number" name="items[${createIndex}][quantity]" min="1"
                       class="w-1/3 rounded-md border border-gray-300 px-3 py-2 text-sm focus:ring-[#4A90E2] focus:border-[#4A90E2]"
                       value="1">
            </div>`;
        container.insertAdjacentHTML('beforeend', html);
        createIndex++;
    }

    function removeLastItem() {
        const container = document.getElementById('add-item-container');
        if (container.children.length > 1) {
            container.lastElementChild.remove();
            createIndex--;
        }
    }
</script>

    </div>
</div>
