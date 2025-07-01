<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Assigned Deliveries</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-white font-['Poppins']" x-data="{ open: true }">
    <div class="flex">

         
            @include('layouts.sidebar') 
       

        <div class="fixed top-0 left-[300px] right-0 bg-white shadow-md h-20 z-10 transition-all duration-300" :class="open ? 'left-[300px]' : 'left-20'">
            @include('layouts.top-navbar') 
            <div class="flex items-center justify-between h-full px-8">
                
        </div>

    <main  :class="open ? 'ml-[5px]' : 'ml-5'" class="transition-all duration-300 p-8 pb-40 relative flex-1 overflow-y-auto h-screen">

    <div class="max-w-6xl mx-auto">
        <h2 class="text-[42px] font-bold text-gray-800 dark:text-white mb-6 border-b border-gray-300 dark:border-gray-600 pb-2 tracking-wide flex items-center gap-4">
            <i class="fa-solid fa-truck-ramp-box text-blue-500 text-4xl w-10 h-10"></i>
            Assigned Deliveries
        </h2>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 bg-white shadow-md rounded-lg">
                <thead class="bg-gray-100 dark:bg-gray-800">
                    <tr>
                        <th class="px-4 py-2">Recipient</th>
                        <th class="px-4 py-2">Package</th>
                        <th class="px-4 py-2">Quantity</th>
                        <th class="px-4 py-2">Supplier</th>
                        <th class="px-4 py-2">Target Delivery</th>
                        <th class="px-4 py-2">Status</th>
                        <th class="px-4 py-2">Created By</th>
                        <th class="px-4 py-2">Proof of Delivery</th>
                        <th class="px-4 py-2 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach ($deliveries as $delivery)
                        <tr>
                            <td class="px-4 py-2">
                                {{ $delivery->recipient->recipient_type === 'school'
                                    ? $delivery->recipient->school->school_name
                                    : $delivery->recipient->division->division_name }}
                            </td>
                            <td class="px-4 py-2">
                                {{ $delivery->recipient->package->packageType->package_code }}
                            </td>
                            <td class="px-4 py-2">
                                {{ $delivery->recipient->quantity }}
                            </td>
                            <td class="px-4 py-2">
                                {{ $delivery->supplier->name }}
                            </td>
                            <td class="px-4 py-2">
                                {{ $delivery->target_delivery ?? '—' }}
                            </td>
                            <td class="px-4 py-2">
                                <form action="{{ route('superadmin.deliveries.updateStatus', $delivery->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <select name="status" onchange="this.form.submit()" class="border px-2 py-1 rounded">
                                        <option value="pending" {{ $delivery->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="delivered" {{ $delivery->status === 'delivered' ? 'selected' : '' }}>Delivered</option>
                                        <option value="cancelled" {{ $delivery->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                </form>
                            </td>
                            <td class="px-4 py-2">
                                {{ $delivery->creator->name ?? '—' }}
                            </td>
                            <td class="px-4 py-2">
                                @if ($delivery->proof_file)
                                    <img src="{{ asset('storage/' . $delivery->proof_file) }}"
                                         alt="Proof"
                                         class="h-16 w-auto rounded border" />
                                @else
                                    <span class="text-gray-400">—</span>
                                @endif
                            </td>
                            <td class="px-4 py-2">
                                <form action="{{ route('deliveries.unassign', $delivery->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Unassign this delivery?')">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="text-red-600 hover:underline">
                                        Unassign
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>

</body>
</html>
