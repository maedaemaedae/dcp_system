<!-- Edit Inventory Modal -->
<div id="editModal-{{ $item->item_id }}" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white p-6 rounded shadow-lg w-full max-w-xl relative">
        <button onclick="closeEditModal({{ $item->item_id }})" class="absolute top-2 right-2 text-gray-500 text-xl hover:text-black">&times;</button>

        <h2 class="text-xl font-semibold mb-4">Edit Item</h2>

        <form method="POST" action="{{ route('inventory.update', $item->item_id) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block font-medium">Item Name</label>
                <input type="text" name="item_name" value="{{ $item->item_name }}" class="w-full border rounded px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label class="block font-medium">Description</label>
                <textarea name="description" class="w-full border rounded px-3 py-2" rows="3">{{ $item->description }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block font-medium">Quantity</label>
                <input type="number" name="quantity" value="{{ $item->quantity }}" class="w-full border rounded px-3 py-2" min="0" required>
            </div>

            <div class="text-right">
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Update</button>
            </div>
        </form>
    </div>
</div>
