<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white">
            Edit Inventory Item
        </h2>
    </x-slot>

    <div class="p-6">
        <form method="POST" action="{{ route('inventory.update', $item->item_id) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="item_name" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Item Name</label>
                <input type="text" name="item_name" id="item_name" value="{{ old('item_name', $item->item_name) }}" required class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                @error('item_name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Description</label>
                <textarea name="description" id="description" rows="3" class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:ring-blue-500 focus:border-blue-500">{{ old('description', $item->description) }}</textarea>
                @error('description') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="flex justify-start space-x-2">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Update
                </button>
                <a href="{{ route('inventory.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
