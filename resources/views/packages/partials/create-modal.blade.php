<div id="addModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white p-6 rounded shadow-lg w-full max-w-2xl relative">
        <button id="closeAddModalBtn" class="absolute top-2 right-2 text-gray-500 text-xl hover:text-black">&times;</button>
        <h2 class="text-xl font-semibold mb-4">Add New Package</h2>

        <form method="POST" action="{{ route('package-types.store') }}">
            @csrf

            <div class="mb-4">
                <label class="block font-medium">Package Code</label>
                <input name="package_code" type="text" class="w-full border px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label class="block font-medium">Description</label>
                <textarea name="description" class="w-full border px-3 py-2"></textarea>
            </div>

            <h3 class="font-semibold mb-2">Items</h3>
            <div id="add-item-container">
                <div class="flex gap-2 mb-2">
                    <select name="items[0][item_id]" class="border px-2 py-1 w-2/3">
                        @foreach ($inventoryItems as $item)
                            <option value="{{ $item->item_id }}">{{ $item->item_name }}</option>
                        @endforeach
                    </select>
                    <input type="number" name="items[0][quantity]" min="1" class="border px-2 py-1 w-1/3" value="1">
                </div>
            </div>

            <button type="button" onclick="addNewItem()" class="text-sm text-blue-600 mb-4">+ Add Another Item</button>

            <div class="text-right">
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Save Package</button>
            </div>
        </form>

        <script>
        let createIndex = 1;
        function addNewItem() {
            const container = document.getElementById('add-item-container');
            const html = `
            <div class="flex gap-2 mb-2">
                <select name="items[${createIndex}][item_id]" class="border px-2 py-1 w-2/3">
                    @foreach ($inventoryItems as $item)
                        <option value="{{ $item->item_id }}">{{ $item->item_name }}</option>
                    @endforeach
                </select>
                <input type="number" name="items[${createIndex}][quantity]" min="1" class="border px-2 py-1 w-1/3" value="1">
            </div>`;
            container.insertAdjacentHTML('beforeend', html);
            createIndex++;
        }
        </script>
    </div>
</div>
