<!-- Edit Modal -->
<div id="editModal-{{ $item->item_id }}" class="fixed inset-0 hidden bg-black/40 z-50 flex items-center justify-center transition duration-300">
    <div class="bg-white w-full max-w-lg rounded-2xl shadow-xl p-8 relative animate-fade-in-up">

        <!-- Close Button -->
        <button onclick="closeEditModal('{{ $item->item_id }}')"
           class="absolute top-3 right-3 text-gray-400 text-2xl hover:text-[#4A90E2] transition">
      &times;
    </button>

        <!-- Modal Header -->
        <h2 class="text-2xl font-semibold text-[#033372] mb-6">Edit Inventory Item</h2>

        <!-- Form -->
        <form method="POST" action="{{ route('inventory.update', $item->item_id) }}" class="space-y-5">
            @csrf
            @method('PUT')

            <!-- Item Name -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Item Name</label>
                <input type="text" name="item_name" value="{{ $item->item_name }}"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150" required>
            </div>

            <!-- Description -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <input type="text" name="description" value="{{ $item->description }}"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150">
            </div>

            <!-- Quantity -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Quantity</label>
                <input type="number" name="quantity" value="{{ $item->quantity }}"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150" required>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end gap-2 pt-2">
                <button type="button" onclick="closeEditModal('{{ $item->item_id }}')"
                    class="inline-flex items-center px-5 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium rounded-md transition">
                    Cancel
                </button>
                <button type="submit"
                    class="inline-flex items-center gap-2 bg-[#4A90E2] hover:bg-[#3a78c2] text-white font-medium px-6 py-2 rounded-md transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                    Update
                </button>
            </div>
        </form>
    </div>
</div>
