<!-- Add Inventory Modal -->
<div id="addModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white w-full max-w-lg rounded-2xl shadow-2xl p-8 relative">
        <!-- Close Button -->
        <button id="closeAddModalBtn" class="absolute top-3 right-3 text-gray-400 hover:text-gray-700 text-2xl font-bold">
            &times;
        </button>

        <!-- Modal Header -->
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Add Inventory Item</h2>

        <!-- Form -->
        <form method="POST" action="{{ route('inventory.store') }}" class="space-y-5">
            @csrf

            <!-- Item Name -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Item Name</label>
                <input type="text" name="item_name" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <!-- Description -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea name="description" rows="4" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 resize-none"></textarea>
            </div>

            <!-- Submit Button -->
            <div class="text-right">
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2 rounded-lg shadow">
                    Save
                </button>
            </div>
        </form>
    </div>
</div>
