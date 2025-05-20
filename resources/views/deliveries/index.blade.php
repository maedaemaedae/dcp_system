<!DOCTYPE html>
<html lang="en" x-data="{ open: true }">
<head>
    <meta charset="UTF-8">
    <title>Deliveries</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/alpinejs" defer></script>


    <script>
    function openDeliveryEditModal(delivery) {
        document.getElementById('editModal').classList.remove('hidden');

        const form = document.getElementById('editDeliveryForm');
        form.action = `/deliveries/${delivery.id}`;

        document.getElementById('edit_school').value = delivery.school_id ?? '';
        document.getElementById('edit_status').value = delivery.status ?? '';
        document.getElementById('edit_delivery_date').value = delivery.delivery_date ?? '';
        document.getElementById('edit_arrival_date').value = delivery.arrival_date ?? '';
        document.getElementById('edit_remarks').value = delivery.remarks ?? '';
    }

    function closeModal(id) {
        document.getElementById(id).classList.add('hidden');
    }
</script>

@if (session('success') && preg_match('/updated/i', session('success')))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let message = @json(session('success')).trim();

        const toast = document.createElement('div');

        // Toast style for "updated"
        let icon = '✏️';
        let bgColor = 'bg-blue-500';

        toast.innerHTML = `
            <div class="flex items-center justify-between space-x-4">
                <div class="flex items-center space-x-3">
                    <span class="text-xl">${icon}</span>
                    <span>${message}</span>
                </div>
                <button onclick="this.parentElement.parentElement.remove()" class="text-white text-xl hover:text-gray-200 transition">&times;</button>
            </div>
        `;

        toast.className = `
            fixed bottom-6 left-1/2 transform -translate-x-1/2
            ${bgColor} text-white px-6 py-3 rounded-xl shadow-lg
            text-sm font-medium z-50 min-w-[300px] max-w-md
            animate-fade-in-up
        `;

        document.body.appendChild(toast);

        setTimeout(() => {
            toast.classList.remove("animate-fade-in-up");
            toast.classList.add("animate-fade-out-down");
            setTimeout(() => toast.remove(), 400);
        }, 4000);
    });
</script>
@endif



<style>
@keyframes fade-in-up {
    0% {
        opacity: 0;
        transform: translateY(20px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}
.animate-fade-in-up {
    animation: fade-in-up 0.4s ease-out forwards;
}

@keyframes fade-out-down {
    0% {
        opacity: 1;
        transform: translateY(0);
    }
    100% {
        opacity: 0;
        transform: translateY(20px);
    }
}
.animate-fade-out-down {
    animation: fade-out-down 0.4s ease-in forwards;
}
</style>


</head>
<body class="bg-white font-['Poppins']" x-data="{ open: true }">
<div class="flex h-screen">

    <div class="w-[1440px] h-[1024px] relative bg-white overflow-hidden">
        <!-- Sidebar -->
        @php
            $authUser = auth()->user();
            $isSuperAdmin = $authUser && $authUser->role_id === 1;
            $isAdmin = $authUser && $authUser->role && $authUser->role->role_name === 'admin';
        @endphp

        <!-- Side Bar -->
    @include('layouts.sidebar')

    <!-- Top Nav Bar -->
    @include('layouts.top-navbar')

    <!-- Main Content -->
    <div :class="open ? 'ml-[300px]' : 'ml-20'" class="transition-all duration-300 pt-24 p-8 relative">
    <h2 class="text-[45px] font-bold text-gray-800 mb-6 border-b border-gray-300 pb-2 tracking-wide">
        🚚 Deliveries
        </h2>

<div class="w-full overflow-x-auto bg-white rounded-2xl shadow border">
        <table class="min-w-full text-sm divide-y divide-gray-200">
            <thead class="bg-[#4A90E2] text-white">
      <tr>
        <th class="px-6 py-3 whitespace-nowrap">School</th>
        <th class="px-6 py-3 whitespace-nowrap">Package</th>
        <th class="px-6 py-3 whitespace-nowrap">Status</th>
        <th class="px-6 py-3 whitespace-nowrap">Delivery Date</th>
        <th class="px-6 py-3 whitespace-nowrap">Arrival Date</th>
        <th class="px-6 py-3 whitespace-nowrap">Remarks</th>
        <th class="px-6 py-3 whitespace-nowrap text-center">Action</th>
      </tr>
    </thead>
    
    <tbody>
      @foreach ($deliveries as $delivery)
      <tr class="border-t border-gray-200 hover:bg-gray-50 transition-colors duration-150">
        <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-800">{{ $delivery->school->school_name }}</td>
        <td class="px-6 py-4 whitespace-nowrap">
          @if ($delivery->project && $delivery->project->packages->count())
            @foreach ($delivery->project->packages as $pkg)
              <div class="mb-1 text-gray-600">{{ $pkg->packageType->package_code ?? 'Unnamed Package' }}</div>
            @endforeach
          @else
            <span class="text-gray-400 italic">N/A</span>
          @endif
        </td>
        <td class="px-6 py-4 whitespace-nowrap">
          <span class="inline-block px-2 py-1 rounded text-xs font-semibold
            {{ $delivery->status === 'Delivered' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
            {{ $delivery->status }}
          </span>
        </td>
        <td class="px-6 py-4 whitespace-nowrap">{{ $delivery->delivery_date ?? '-' }}</td>
        <td class="px-6 py-4 whitespace-nowrap">{{ $delivery->arrival_date ?? '-' }}</td>
        <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{ $delivery->remarks ?? '-' }}</td>
        <td class="px-6 py-4 whitespace-nowrap text-center">
          @php
    $deliveryJson = json_encode([
        'id' => $delivery->id,
        'school_id' => $delivery->school_id,
        'status' => $delivery->status,
        'delivery_date' => $delivery->delivery_date,
        'arrival_date' => $delivery->arrival_date,
        'remarks' => $delivery->remarks,
    ]);
@endphp

<button
    onclick='openDeliveryEditModal({!! $deliveryJson !!})'
    class="px-4 py-1.5 rounded-full bg-[#4A90E2] text-white hover:bg-[#357ABD] transition shadow-sm text-sm font-medium">
                                Edit
                            </button>

        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

    <!-- Include Edit Modal -->
    @include('deliveries.edit')
</body>
</html>