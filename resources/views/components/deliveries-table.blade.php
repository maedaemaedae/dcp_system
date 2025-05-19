<table class="min-w-full text-sm">
    <thead class="bg-gray-100 text-gray-700 text-left">
        <tr>
            <th class="px-4 py-2">School</th>
            <th class="px-4 py-2">Package</th>
            <th class="px-4 py-2">Status</th>
            <th class="px-4 py-2">Delivery Date</th>
            <th class="px-4 py-2">Arrival Date</th>
            <th class="px-4 py-2">Remarks</th>
            <th class="px-4 py-2">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($deliveries as $delivery)
            <tr class="border-t">
                <td class="px-4 py-2">{{ $delivery->school->school_name ?? '-' }}</td>
                <td class="px-4 py-2">{{ $delivery->package->packageType->name ?? '-' }}</td>
                <td class="px-4 py-2">{{ $delivery->status }}</td>
                <td class="px-4 py-2">{{ $delivery->delivery_date }}</td>
                <td class="px-4 py-2">{{ $delivery->arrival_date }}</td>
                <td class="px-4 py-2">{{ $delivery->remarks }}</td>
                <td class="px-4 py-2">
                    <a href="{{ route($editRoute, $delivery->id) }}" class="text-blue-600 hover:underline">Edit</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>