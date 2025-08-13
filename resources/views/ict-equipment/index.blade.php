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
                    <th class="p-2">Action</th>
                </tr>
            </thead>
            <tbody id="equipment-table">
                @forelse ($equipments as $equip)
                    <tr class="bg-white border-b" data-id="{{ $equip->id }}">
                        <td class="p-2 view-mode">{{ $equip->equipment_id }}</td>
                        <td class="p-2 view-mode">{{ $equip->item_description }}</td>
                        <td class="p-2 view-mode">{{ $equip->category }}</td>
                        <td class="p-2 view-mode">{{ $equip->brand }}</td>
                        <td class="p-2 view-mode">{{ $equip->model }}</td>
                        <td class="p-2 view-mode">{{ $equip->asset_number }}</td>
                        <td class="p-2 view-mode">{{ $equip->serial_number }}</td>
                        <td class="p-2 view-mode">{{ $equip->location }}</td>
                        <td class="p-2 view-mode">{{ $equip->assigned_to }}</td>
                        <td class="p-2 view-mode">{{ $equip->purchase_date->format('Y-m-d') }}</td>
                        <td class="p-2 view-mode">{{ $equip->warranty_expiry->format('Y-m-d') }}</td>
                        <td class="p-2 view-mode">{{ $equip->condition }}</td>
                        <td class="p-2 view-mode whitespace-pre-wrap">{{ $equip->note ?? '—' }}</td>
                        <td class="p-2 flex gap-2">
                            <button class="edit-btn px-2 py-1 bg-blue-500 hover:bg-blue-600 text-white rounded">Edit</button>
                            <form action="{{ route('ict-equipment.destroy', $equip->id) }}" method="POST" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-2 py-1 bg-red-500 hover:bg-red-600 text-white rounded">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="14" class="p-4 text-center text-gray-500">No ICT equipment found.</td>
                    </tr>
                @endforelse
            </tbody>

            <script>
            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('edit-btn')) {
                    let row = e.target.closest('tr');
                    row.querySelectorAll('.view-mode').forEach(td => {
                        let text = td.textContent.trim();
                        if (td.cellIndex === 11) { // Condition select
                            td.innerHTML = `<select class="border rounded p-1 w-full">
                                <option value="IN USE" ${text === "IN USE" ? 'selected' : ''}>IN USE</option>
                                <option value="FOR REPAIR" ${text === "FOR REPAIR" ? 'selected' : ''}>FOR REPAIR</option>
                            </select>`;
                        } else if (td.cellIndex === 9 || td.cellIndex === 10) { // Dates
                            td.innerHTML = `<input type="date" class="border rounded p-1 w-full" value="${text}">`;
                        } else if (td.cellIndex === 12) { // Note textarea
                            td.innerHTML = `<textarea class="border rounded p-1 w-full">${text !== '—' ? text : ''}</textarea>`;
                        } else {
                            td.innerHTML = `<input type="text" class="border rounded p-1 w-full" value="${text}">`;
                        }
                    });
                    e.target.textContent = "Save";
                    e.target.classList.remove("edit-btn");
                    e.target.classList.add("save-btn");
                }
                else if (e.target.classList.contains('save-btn')) {
                    let row = e.target.closest('tr');
                    let id = row.dataset.id;
                    let inputs = row.querySelectorAll('input, select, textarea');
                    let data = {
                        _token: '{{ csrf_token() }}',
                        _method: 'PUT'
                    };
                    let fields = ['equipment_id','item_description','category','brand','model','asset_number','serial_number','location','assigned_to','purchase_date','warranty_expiry','condition','note'];
                    inputs.forEach((input, i) => data[fields[i]] = input.value);

                    fetch(`/ict-equipment/${id}`, {
                        method: 'POST',
                        headers: { 'X-Requested-With': 'XMLHttpRequest' },
                        body: new FormData(Object.assign(new FormData(), Object.entries(data).reduce((fd, [k, v]) => {fd.append(k, v); return fd;}, new FormData())))
                    })
                    .then(res => res.json())
                    .then(res => {
                        if (res.success) {
                            location.reload();
                        }
                    });
                }
            });
            </script>

        </table>
    </div>

</body>
</html>