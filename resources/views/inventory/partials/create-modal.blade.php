<!-- Add Inventory Modal -->
<div id="addModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white p-6 rounded shadow-lg w-full max-w-xl relative">
        <button id="closeAddModalBtn" class="absolute top-2 right-2 text-gray-500 text-xl hover:text-black">&times;</button>
        <h2 class="text-xl font-semibold mb-4">Add Inventory Item</h2>

        <form method="POST" action="{{ route('inventory.store') }}">
            @csrf

            <div class="mb-4">
                <label class="block font-medium">Item Name</label>
                <input type="text" name="item_name" class="w-full border rounded px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label class="block font-medium">Description</label>
                <textarea name="description" class="w-full border rounded px-3 py-2" rows="3"></textarea>
            </div>

            <div class="mb-4">
                <label class="block font-medium">Quantity</label>
                <input type="number" name="quantity" class="w-full border rounded px-3 py-2" min="0" required>
            </div>

            <div class="text-right">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Save</button>
            </div>
        </form>
    </div>
</div>
