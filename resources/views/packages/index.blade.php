<x-app-layout>
    <div class="max-w-7xl mx-auto py-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold">Package Types</h2>
            <button id="openAddModalBtn" class="bg-blue-600 text-white px-4 py-2 rounded">+ Add Package</button>
        </div>

        @foreach ($packages as $package)
            <div class="bg-white p-4 shadow rounded mb-4">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-lg font-semibold">{{ $package->package_code }}</h3>
                        <p>{{ $package->description }}</p>
                    </div>
                    <div class="flex gap-2">
                        <button onclick="openEditModal({{ $package->id }})" class="text-blue-600 hover:underline">Edit</button>
                        <form method="POST" action="{{ route('package-types.destroy', $package->id) }}" onsubmit="return confirm('Are you sure you want to delete this package?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Delete</button>
                        </form>
                    </div>
                </div>
                <ul class="mt-2 text-sm text-gray-700">
                    @foreach ($package->contents as $content)
                        <li>{{ $content->inventory->item_name }} – Qty: {{ $content->quantity }}</li>
                    @endforeach
                </ul>
            </div>

            @include('packages.partials.edit-modal', ['packageType' => $package, 'inventoryItems' => $inventoryItems])
        @endforeach
    </div>

    @include('packages.partials.create-modal', ['inventoryItems' => $inventoryItems])

    <script>
        const addModal = document.getElementById('addModal');
        const openAddBtn = document.getElementById('openAddModalBtn');
        const closeAddBtn = document.getElementById('closeAddModalBtn');

        openAddBtn.addEventListener('click', () => {
            addModal.classList.remove('hidden');
            addModal.classList.add('flex');
        });

        closeAddBtn.addEventListener('click', () => {
            addModal.classList.add('hidden');
            addModal.classList.remove('flex');
        });

        function openEditModal(id) {
            const modal = document.getElementById(`editModal-${id}`);
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeEditModal(id) {
            const modal = document.getElementById(`editModal-${id}`);
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    </script>
</x-app-layout>
