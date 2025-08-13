<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ICT Equipment | DCP Tracking Hub</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 p-8 font-sans">

    <div class="max-w-7xl mx-auto">
        <h1 class="text-3xl font-bold mb-6">ICT Equipment</h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('ict-equipment.store') }}" method="POST" class="mb-8">
            @csrf
            <table class="w-full border border-gray-200 rounded-lg overflow-hidden">
                <thead class="bg-blue-100 text-left text-sm">
                    <tr>
                        <th class="p-2">Equipment ID</th>
                        <th class="p-2">Description</th>
                        <th class="p-2">Category</th>
                        <th class="p-2">Brand</th>
                        <th class="p-2">Model</th>
                        <th class="p-2">Asset #</th>
                        <th class="p-2">Serial #</th>
                        <th class="p-2">Location</th>
                        <th class="p-2">Assigned To</th>
                        <th class="p-2">Purchase Date</th>
                        <th class="p-2">Warranty Expiry</th>
                        <th class="p-2">Condition</th>
                        <th class="p-2">Note</th>
                        <th class="p-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white">
                        <td class="p-2"><input type="text" name="equipment_id" class="border rounded p-1 w-full" required></td>
                        <td class="p-2"><input type="text" name="item_description" class="border rounded p-1 w-full" required></td>
                        <td class="p-2"><input type="text" name="category" class="border rounded p-1 w-full" required></td>
                        <td class="p-2"><input type="text" name="brand" class="border rounded p-1 w-full" required></td>
                        <td class="p-2"><input type="text" name="model" class="border rounded p-1 w-full" required></td>
                        <td class="p-2"><input type="text" name="asset_number" class="border rounded p-1 w-full" required></td>
                        <td class="p-2"><input type="text" name="serial_number" class="border rounded p-1 w-full" required></td>
                        <td class="p-2"><input type="text" name="location" class="border rounded p-1 w-full" required></td>
                        <td class="p-2"><input type="text" name="assigned_to" class="border rounded p-1 w-full" required></td>
                        <td class="p-2"><input type="date" name="purchase_date" class="border rounded p-1 w-full" required></td>
                        <td class="p-2"><input type="date" name="warranty_expiry" class="border rounded p-1 w-full" required></td>
                        <td class="p-2">
                            <select name="condition" class="border rounded p-1 w-full" required>
                                <option value="IN USE">IN USE</option>
                                <option value="FOR REPAIR">FOR REPAIR</option>
                            </select>
                        </td>
                        <td class="p-2"><textarea name="note" class="border rounded p-1 w-full"></textarea></td>
                        <td class="p-2">
                            <button type="submit" class="px-3 py-1 bg-green-500 hover:bg-green-600 text-white rounded">
                                Save
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
        <h2 class="text-xl font-semibold mb-4">Existing ICT Equipment</h2>
        <table class="w-full border border-gray-200 rounded-lg overflow-hidden">
            <thead class="bg-gray-200 text-sm">
                <tr>
                    <th class="p-2">Equipment ID</th>
                    <th class="p-2">Description</th>
                    <th class="p-2">Category</th>
                    <th class="p-2">Brand</th>
                    <th class="p-2">Model</th>
                    <th class="p-2">Asset #</th>
                    <th class="p-2">Serial #</th>
                    <th class="p-2">Location</th>
                    <th class="p-2">Assigned To</th>
                    <th class="p-2">Purchase Date</th>
                    <th class="p-2">Warranty Expiry</th>
                    <th class="p-2">Condition</th>
                    <th class="p-2">Note</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($equipments as $equip)
                    <tr class="bg-white border-b">
                        <td class="p-2">{{ $equip->equipment_id }}</td>
                        <td class="p-2">{{ $equip->item_description }}</td>
                        <td class="p-2">{{ $equip->category }}</td>
                        <td class="p-2">{{ $equip->brand }}</td>
                        <td class="p-2">{{ $equip->model }}</td>
                        <td class="p-2">{{ $equip->asset_number }}</td>
                        <td class="p-2">{{ $equip->serial_number }}</td>
                        <td class="p-2">{{ $equip->location }}</td>
                        <td class="p-2">{{ $equip->assigned_to }}</td>
                        <td class="p-2">{{ $equip->purchase_date->format('Y-m-d') }}</td>
                        <td class="p-2">{{ $equip->warranty_expiry->format('Y-m-d') }}</td>
                        <td class="p-2">{{ $equip->condition }}</td>
                        <td class="p-2 whitespace-pre-wrap">{{ $equip->note ?? '—' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="13" class="p-4 text-center text-gray-500">No ICT equipment found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</body>
</html>