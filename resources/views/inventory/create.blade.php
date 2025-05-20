<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white">
            Add Inventory Item
        </h2>
    </x-slot>

    <div class="p-6">
        <form method="POST" action="{{ route('inventory.store') }}">
            @csrf

            <div class="mb-4">
                <label for="item_name" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Item Name</label>
                <input type="text" name="item_name" id="item_name" required class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                @error('item_name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Description</label>
                <textarea name="description" id="description" rows="3" class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:ring-blue-500 focus:border-blue-500"></textarea>
                @error('description') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="flex justify-start space-x-2">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Save
                </button>
                <button id="closeAddModalBtn" onclick="closeAddModal()" class="absolute top-2 right-2 text-gray-500 text-xl hover:text-black">&times;</button>


            </div>
        </form>
    </div>
</x-app-layout>
