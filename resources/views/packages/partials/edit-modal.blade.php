<div id="editModal-{{ $packageType->id }}" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white p-6 rounded shadow-lg w-full max-w-2xl relative">
        <button onclick="closeEditModal({{ $packageType->id }})" class="absolute top-2 right-2 text-gray-500 text-xl hover:text-black">&times;</button>

        <h2 class="text-xl font-semibold mb-4">Edit Package</h2>

        <form method="POST" action="{{ route('package-types.update', $packageType->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block font-medium">Package Code</label>
                <input name="package_code" type="text" class="w-full border px-3 py-2" value="{{ $packageType->package_code }}" required>
            </div>

            <div class="mb-4">
                <label class="block font-medium">Description</label>
                <textarea name="description" class="w-full border px-3 py-2">{{ $packageType->description }}</textarea>
            </div>

            <h3 class="font-semibold mb-2">Items</h3>
            <div id="edit-item-container-{{ $packageType->id }}">
                @foreach ($packageType->contents as $index => $content)
                    <div class="flex gap-2 mb-2">
                        <select name="items[{{ $index }}][item_id]" class="border px-2 py-1 w-2/3">
                            @foreach ($inventoryItems as $item)
                                <option value="{{ $item->item_id }}" {{ $content->item_id == $item->item_id ? 'selected' : '' }}>
                                    {{ $item->item_name }}
                                </option>
                            @endforeach
                        </select>
                        <input type="number" name="items[{{ $index }}][quantity]" min="1" class="border px-2 py-1 w-1/3" value="{{ $content->quantity }}">
                    </div>
                @endforeach
            </div>

            <button type="button" onclick="addEditItem({{ $packageType->id }})" class="text-sm text-blue-600 mb-4">+ Add Another Item</button>

            <div class="text-right">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update Package</button>
            </div>
        </form>

        <script>
        let editIndex{{ $packageType->id }} = {{ count($packageType->contents) }};
        function addEditItem(id) {
            const container = document.getElementById(`edit-item-container-${id}`);
            const html = `
            <div class="flex gap-2 mb-2">
                <select name="items[${editIndex{{ $packageType->id }} }][item_id]" class="border px-2 py-1 w-2/3">
                    @foreach ($inventoryItems as $item)
                        <option value="{{ $item->item_id }}">{{ $item->item_name }}</option>
                    @endforeach
                </select>
                <input type="number" name="items[${editIndex{{ $packageType->id }} }][quantity]" min="1" class="border px-2 py-1 w-1/3" value="1">
            </div>`;
            container.insertAdjacentHTML('beforeend', html);
            editIndex{{ $packageType->id }}++;
        }
        </script>
    </div>
</div>
