<x-app-layout>
    <div class="max-w-3xl mx-auto py-6">
        <h2 class="text-2xl font-bold mb-4">Update Delivery (Supplier)</h2>

        <form method="POST" action="{{ route('supplier.deliveries.update', $delivery->id) }}" class="bg-white p-6 rounded shadow">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block mb-1 font-medium">Status:</label>
                <select name="status" class="w-full border rounded p-2">
                    <option {{ $delivery->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option {{ $delivery->status == 'In Transit' ? 'selected' : '' }}>In Transit</option>
                    <option {{ $delivery->status == 'Delivered' ? 'selected' : '' }}>Delivered</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-medium">Delivery Date:</label>
                <input type="date" name="delivery_date" value="{{ $delivery->delivery_date }}" class="w-full border rounded p-2">
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-medium">Arrival Date:</label>
                <input type="date" name="arrival_date" value="{{ $delivery->arrival_date }}" class="w-full border rounded p-2">
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-medium">Remarks:</label>
                <textarea name="remarks" rows="3" class="w-full border rounded p-2">{{ $delivery->remarks }}</textarea>
            </div>

            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded">
                Save Changes
            </button>
        </form>
    </div>
</x-app-layout>
