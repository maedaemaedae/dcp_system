<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Assigned Deliveries</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <script>
        // Prevent zoom with Ctrl + Mouse Wheel and Ctrl + +/- on desktop
            document.addEventListener('wheel', function(e) {
                if (e.ctrlKey) {
                    e.preventDefault();
                }
            }, { passive: false });

            document.addEventListener('keydown', function(e) {
                // Prevent Ctrl + '+', Ctrl + '-', Ctrl + '0'
                if (e.ctrlKey && (e.key === '+' || e.key === '-' || e.key === '=' || e.key === '0')) {
                    e.preventDefault();
                }
            });
    </script>
    
</head>
<body class="bg-white font-['Poppins']" x-data="{ open: true }">
    <div class="flex">

    @if (session('success'))
    <div 
        x-data="{ show: true }" 
        x-init="setTimeout(() => show = false, 5000)" 
        x-show="show" 
        x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="opacity-0 -translate-y-4 scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
        x-transition:leave="transition ease-in duration-200 transform"
        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
        x-transition:leave-end="opacity-0 -translate-y-4 scale-95"
        class="fixed top-6 left-1/2 transform -translate-x-1/2 z-50 
               bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg 
               text-sm flex items-center gap-2"
    >
        <i class="fa-solid fa-circle-check"></i>
        {{ session('success') }}
    </div>
@endif

         
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

        <div class="overflow-x-auto bg-white shadow-lg rounded-xl border border-gray-200">
    <table class="min-w-full text-sm text-left">
        <thead class="bg-[#4A90E2] text-white uppercase text-xs tracking-wider">
            <tr>
                <th class="px-6 py-4">Recipient</th>
                <th class="px-6 py-4">Package</th>
                <th class="px-6 py-4 text-center">Quantity</th>
                <th class="px-6 py-4 text-center">Target Date</th>
                <th class="px-6 py-4 text-center">Status</th>
                <th class="px-6 py-4 text-center">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse ($deliveries as $delivery)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 font-medium text-gray-800">
                        {{ $delivery->recipient->recipient_type === 'school'
                            ? $delivery->recipient->school->school_name
                            : $delivery->recipient->division->division_name }}
                    </td>
                    <td class="px-6 py-4 text-gray-700">
                        {{ $delivery->recipient->package->packageType->package_code }}
                    </td>
                    <td class="px-6 py-4 text-center text-gray-700">
                        {{ $delivery->recipient->quantity }}
                    </td>
                    <td class="px-6 py-4 text-center text-gray-700">
                        {{ $delivery->target_delivery ?? '—' }}
                    </td>
                    <td class="px-6 py-4 text-center capitalize">
                        <span class="inline-block px-2 py-1 rounded-full text-xs font-semibold
                            {{ $delivery->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : 'bg-green-100 text-green-700' }}">
                            {{ $delivery->status }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        @if ($delivery->status === 'pending')
                            <form method="POST"
                                action="{{ route('supplier.deliveries.confirm', $delivery->id) }}"
                                enctype="multipart/form-data"
                                class="flex justify-center items-center gap-2">
                                @csrf
                                @method('PUT')

                                @if ($errors->any())
                                    <div class="text-red-600 text-xs mb-1">
                                        {{ $errors->first('proof_file') }}
                                    </div>
                                @endif

                                <label for="file-upload-{{ $delivery->id }}"
                                    class="inline-flex items-center justify-center w-10 h-10 bg-[#4A90E2] hover:bg-[#357ABD] text-white rounded-full cursor-pointer transition duration-150 ease-in-out"
                                    title="Upload proof & mark as delivered">
                                    <i class="fas fa-paperclip"></i>
                                    <input id="file-upload-{{ $delivery->id }}"
                                        type="file"
                                        name="proof_file"
                                        accept="application/pdf"
                                        required
                                        class="hidden"
                                        onchange="if(this.files[0].size > 2 * 1024 * 1024) {
                                                        alert('File must be less than 2MB');
                                                        this.value = '';
                                                    } else {
                                                        this.form.submit();
                                                    }" />
                                </label>
                            </form>

                        @else
                            <span class="text-green-700 font-semibold">Delivered</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-6 text-center text-gray-400">
                        No deliveries assigned yet.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

    </main>

</body>
</html>
