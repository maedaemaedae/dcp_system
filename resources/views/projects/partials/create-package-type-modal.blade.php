
<div id="createPackageTypeModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-2xl p-6">
        <h2 class="text-xl font-semibold mb-4">Add Package Type</h2>
        <form action="{{ route('package-types.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="package_code" class="block font-medium text-sm text-gray-700">Package Code</label>
                <input type="text" name="package_code" id="package_code" class="w-full border-gray-300 rounded" required>
            </div>

            <div class="mb-4">
                <label for="description" class="block font-medium text-sm text-gray-700">Description</label>
                <textarea name="description" rows="2" class="w-full border-gray-300 rounded"></textarea>
            </div>

            <div class="mb-2 font-semibold">Items:</div>
            <div id="itemContainer" class="space-y-2">
                <div class="flex space-x-2">
                    <input type="text" name="items[0][item_name]" class="w-1/2 border rounded" placeholder="Item Name" required>
                    <input type="number" name="items[0][quantity]" class="w-1/4 border rounded" placeholder="Qty" required>
                    <input type="text" name="items[0][description]" class="w-1/4 border rounded" placeholder="Description">
                </div>
            </div>

            <div class="mt-3">
                <button type="button" onclick="addItemRow()" class="text-sm text-blue-600 hover:underline">+ Add Another Item</button>
            </div>

            <div class="mt-6 flex justify-end space-x-2">
                <button type="button" onclick="closeModal('createPackageTypeModal')" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Create</button>
            </div>
        </form>
    </div>
</div>

<script>
    let itemIndex = 1;
    function addItemRow() {
        const container = document.getElementById('itemContainer');
        const row = document.createElement('div');
        row.classList = "flex space-x-2 mt-2";
        row.innerHTML = `
            <input type="text" name="items[\${itemIndex}][item_name]" class="w-1/2 border rounded" placeholder="Item Name" required>
            <input type="number" name="items[\${itemIndex}][quantity]" class="w-1/4 border rounded" placeholder="Qty" required>
            <input type="text" name="items[\${itemIndex}][description]" class="w-1/4 border rounded" placeholder="Description">
        `;
        container.appendChild(row);
        itemIndex++;
    }
</script>
