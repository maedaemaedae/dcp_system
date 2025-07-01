<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Assigned Deliveries</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            My Deliveries
        </h2>
        @if (session('success'))
            <div class="mb-4 text-green-600 font-medium">{{ session('success') }}</div>
        @endif

        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-[#4A90E2] text-white uppercase text-xs tracking-wider">
                <tr>
                    <th class="px-4 py-2">Recipient</th>
                    <th class="px-4 py-2">Package</th>
                    <th class="px-4 py-2">Quantity</th>
                    <th class="px-4 py-2">Target Date</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Action</th>
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
                        <td class="px-4 py-2">{{ $delivery->recipient->package->packageType->package_code }}</td>
                        <td class="px-4 py-2">{{ $delivery->recipient->quantity }}</td>
                        <td class="px-4 py-2">{{ $delivery->target_delivery ?? '—' }}</td>
                        <td class="px-4 py-2 capitalize">{{ $delivery->status }}</td>
                        <td class="px-4 py-2">
                            @if ($delivery->status === 'pending')
                                <form method="POST"
                                      action="{{ route('supplier.deliveries.confirm', $delivery->id) }}"
                                      enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    @if ($errors->any())
                                        <div class="mb-2 text-red-600 text-sm">
                                            {{ $errors->first('proof_file') }}
                                        </div>
                                    @endif

                                    <input type="file"
                                           name="proof_file"
                                           accept="image/*"
                                           required
                                           class="mb-2 block text-sm text-gray-600"
                                           onchange="if(this.files[0].size > 2 * 1024 * 1024) { alert('Image must be less than 2MB'); this.value = ''; }" />

                                    <button type="submit"
                                            class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded">
                                        Mark as Delivered
                                    </button>
                                </form>
                            @else
                                <span class="text-green-700 font-semibold">Delivered</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>

</body>
</html>
