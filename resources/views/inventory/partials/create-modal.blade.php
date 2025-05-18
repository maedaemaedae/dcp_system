<!-- Add Inventory Modal -->
<div id="addModal" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50 transition duration-300">
    <div class="bg-white w-full max-w-lg rounded-2xl shadow-xl p-8 relative animate-fade-in-up">
        
        <!-- Close Button -->
        <button id="closeAddModalBtn"
            class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition duration-150 ease-in-out text-2xl font-bold">
            &times;
        </button>

        <!-- Modal Header -->
        <h2 class="text-2xl font-semibold text-[#033372] mb-6">Add Inventory Item</h2>

        <!-- Form -->
        <form method="POST" action="{{ route('inventory.store') }}" class="space-y-5">
            @csrf

            <!-- Item Name -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Item Name</label>
                <input type="text" name="item_name"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150"
                    required>
            </div>
            
            <!-- Quantity -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Quantity</label>
                <input type="number" name="quantity" min="0"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150"
                    required>
            </div>
            
            <!-- Description -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea name="description" rows="4"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 resize-none transition duration-150"></textarea>
            </div>

            <!-- Submit Button -->
            <div class="text-right">
                <button type="submit"
                    class="inline-flex items-center gap-2 bg-[#4A90E2] hover:bg-[#3a78c2] text-white font-medium px-6 py-2 rounded-md transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M5 13l4 4L19 7" />
                    </svg>
                    Save
                </button>
            </div>
        </form>
    </div>
</div>
