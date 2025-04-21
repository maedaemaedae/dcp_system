<x-app-layout>
    <div class="max-w-3xl mx-auto py-6">
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
            <div id="item-container">
                <div class="flex gap-2 mb-2">
                    <select name="items[0][item_id]" class="border px-2 py-1 w-2/3">
                        @foreach ($inventoryItems as $item)
                            <option value="{{ $item->item_id }}">{{ $item->item_name }}</option>
                        @endforeach
                    </select>
                    <input type="number" name="items[0][quantity]" min="1" class="border px-2 py-1 w-1/3" value="1">
                </div>
            </div>

            <button type="button" onclick="addItem()" class="text-sm text-blue-600 mb-4">+ Add Another Item</button>

            <div>
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Save Package</button>
            </div>
        </form>
    </div>

    <script>
    let index = 1;
    function addItem() {
        const container = document.getElementById('item-container');
        const html = `
        <div class="flex gap-2 mb-2">
            <select name="items[${index}][item_id]" class="border px-2 py-1 w-2/3">
                @foreach ($inventoryItems as $item)
                    <option value="{{ $item->item_id }}">{{ $item->item_name }}</option>
                @endforeach
            </select>
            <input type="number" name="items[${index}][quantity]" min="1" class="border px-2 py-1 w-1/3" value="1">
        </div>`;
        container.insertAdjacentHTML('beforeend', html);
        index++;
    }
    </script>
</x-app-layout>