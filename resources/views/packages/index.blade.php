<x-app-layout>
    <div class="max-w-7xl mx-auto py-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold">Package Types</h2>
            <a href="{{ route('package-types.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Add Package</a>
        </div>

        @foreach ($packages as $package)
            <div class="bg-white p-4 shadow rounded mb-4">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-lg font-semibold">{{ $package->package_code }}</h3>
                        <p>{{ $package->description }}</p>
                    </div>
                    <div>
                        <div class="flex gap-2">
                            <a href="{{ route('package-types.edit', $package->id) }}" class="text-blue-600 hover:underline">Edit</a>
                            <form method="POST" action="{{ route('package-types.destroy', $package->id) }}" onsubmit="return confirm('Are you sure you want to delete this package?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
                <ul class="mt-2 text-sm text-gray-700">
                    @foreach ($package->contents as $content)
                        <li>{{ $content->inventory->item_name }} – Qty: {{ $content->quantity }}</li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
</x-app-layout>
