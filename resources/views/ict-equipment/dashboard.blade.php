<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ICT Equipment Dashboard | DCP Tracking Hub</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="icon" href="{{ asset('images/final-portrait-logo.png') }}" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>[x-cloak] { display: none !important; }</style>
</head>
<body class="bg-gray-50 font-['Poppins'] text-gray-800">

@include('layouts.top-navbar') 

<!-- Page Content Wrapper (adds space below navbar) -->
<div class="pt-28 px-6">  
    <!-- Back to Inventory Button -->
    <div>
        <a href="{{ route('inventory.index') }}"
           class="inline-flex items-center text-[#4A90E2] hover:text-white bg-white hover:bg-[#4A90E2] border border-[#4A90E2] text-sm font-medium transition-all duration-300 ease-in-out px-4 py-2 rounded-full shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2"
                 fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            Back to Inventory
        </a>
    </div>

    <!-- Dashboard container -->
    <div class="max-w-6xl mx-auto py-10">
        <h2 class="text-[42px] font-bold text-gray-800 dark:text-white mb-6 border-b border-gray-300 dark:border-gray-600 pb-2 tracking-wide flex items-center gap-4">
    <i class="fa-solid fa-laptop text-blue-500 text-3xl"></i>
    ICT Equipment Dashboard
</h2>



        <!-- Metric Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-6 mb-12">
    <a class="group bg-white rounded-2xl shadow-md hover:shadow-xl p-6 flex flex-col items-center transition transform hover:-translate-y-1">
        <div class="bg-blue-100 text-blue-500 p-3 rounded-full mb-3 group-hover:scale-110 transition">
            <i class="fa-solid fa-desktop text-2xl"></i>
        </div>
        <span class="text-sm text-gray-500">Total Equipments</span>
        <span class="text-3xl font-bold mt-1">{{ $totalEquipments ?? 0 }}</span>
    </a>

    <a href="{{ route('ict-equipment.index', ['condition' => 'IN USE']) }}"
       class="group bg-white rounded-2xl shadow-md hover:shadow-xl p-6 flex flex-col items-center transition transform hover:-translate-y-1">
        <div class="bg-green-100 text-green-500 p-3 rounded-full mb-3 group-hover:scale-110 transition">
            <i class="fa-solid fa-check-circle text-2xl"></i>
        </div>
        <span class="text-sm text-gray-500">In Use</span>
        <span class="text-3xl font-bold mt-1">{{ $inUseCount ?? 0 }}</span>
    </a>

    <a href="{{ route('ict-equipment.index', ['condition' => 'FOR REPAIR']) }}"
       class="group bg-white rounded-2xl shadow-md hover:shadow-xl p-6 flex flex-col items-center transition transform hover:-translate-y-1">
        <div class="bg-yellow-100 text-yellow-500 p-3 rounded-full mb-3 group-hover:scale-110 transition">
            <i class="fa-solid fa-tools text-2xl"></i>
        </div>
        <span class="text-sm text-gray-500">For Repair</span>
        <span class="text-3xl font-bold mt-1">{{ $forRepairCount ?? 0 }}</span>
    </a>

    <a href="{{ route('ict-equipment.index', ['category' => 'laptop']) }}"
       class="group bg-white rounded-2xl shadow-md hover:shadow-xl p-6 flex flex-col items-center transition transform hover:-translate-y-1">
        <div class="bg-indigo-100 text-indigo-500 p-3 rounded-full mb-3 group-hover:scale-110 transition">
            <i class="fa-solid fa-laptop text-2xl"></i>
        </div>
        <span class="text-sm text-gray-500">Laptops</span>
        <span class="text-3xl font-bold mt-1">{{ $laptopCount ?? 0 }}</span>
    </a>

    <a href="{{ route('ict-equipment.index', ['category' => 'printer']) }}"
       class="group bg-white rounded-2xl shadow-md hover:shadow-xl p-6 flex flex-col items-center transition transform hover:-translate-y-1">
        <div class="bg-pink-100 text-pink-500 p-3 rounded-full mb-3 group-hover:scale-110 transition">
            <i class="fa-solid fa-print text-2xl"></i>
        </div>
        <span class="text-sm text-gray-500">Printers</span>
        <span class="text-3xl font-bold mt-1">{{ $printerCount ?? 0 }}</span>
    </a>

    <a href="{{ route('ict-equipment.index', ['category' => 'desktop']) }}"
       class="group bg-white rounded-2xl shadow-md hover:shadow-xl p-6 flex flex-col items-center transition transform hover:-translate-y-1">
        <div class="bg-purple-100 text-purple-500 p-3 rounded-full mb-3 group-hover:scale-110 transition">
            <i class="fa-solid fa-desktop text-2xl"></i>
        </div>
        <span class="text-sm text-gray-500">Desktops</span>
        <span class="text-3xl font-bold mt-1">{{ $desktopCount ?? 0 }}</span>
    </a>
</div>

<!-- Charts Section -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-8">

    <!-- Equipment by Category -->
    <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition transform hover:-translate-y-1">
        <div class="bg-gradient-to-r from-indigo-500 to-blue-500 rounded-t-2xl p-4">
            <h3 class="text-lg font-semibold text-white text-center">Equipment by Category</h3>
        </div>
        <div class="p-8 h-[400px]">
            <canvas id="categoryChart" class="w-full h-[320px]"></canvas>
        </div>
    </div>

    <!-- Equipment by Location -->
    <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition transform hover:-translate-y-1">
        <div class="bg-gradient-to-r from-green-500 to-teal-500 rounded-t-2xl p-4">
            <h3 class="text-lg font-semibold text-white text-center">Equipment by Location</h3>
        </div>
        <div class="p-8 h-[400px]">
            <canvas id="locationChart" class="w-full h-[320px]"></canvas>
        </div>
    </div>
</div>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Equipment by Category
            const categoryData = [
                @foreach ($categoryCounts as $cat)
                    { category: "{{ is_array($cat) ? $cat['category'] : $cat->category }}", count: {{ is_array($cat) ? $cat['count'] : $cat->count }} },
                @endforeach
            ];
            const categoryCtx = document.getElementById('categoryChart').getContext('2d');
            new Chart(categoryCtx, {
                type: 'doughnut',
                data: {
                    labels: categoryData.map(e => e.category),
                    datasets: [{
                        data: categoryData.map(e => e.count),
                        backgroundColor: ['#4F46E5', '#16A34A', '#F59E0B', '#EF4444', '#3B82F6', '#A855F7'],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'bottom' }
                    }
                }
            });

            // Equipment by Location
            const locationData = [
                @foreach ($locationCounts as $loc)
                    { location: "{{ is_array($loc) ? $loc['location'] : $loc->location }}", count: {{ is_array($loc) ? $loc['count'] : $loc->count }} },
                @endforeach
            ];
            const locationCtx = document.getElementById('locationChart').getContext('2d');
            new Chart(locationCtx, {
                type: 'bar',
                data: {
                    labels: locationData.map(e => e.location),
                    datasets: [{
                        label: 'Equipments',
                        data: locationData.map(e => e.count),
                        backgroundColor: '#60A5FA',
                        borderRadius: 8,
                        barThickness: 30,
                        maxBarThickness: 40,
                        hoverBackgroundColor: '#2563EB',
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        x: {
                            ticks: { color: '#4B5563', font: { size: 13, weight: '500', family: 'Inter, sans-serif' } },
                            grid: { display: false }
                        },
                        y: {
                            beginAtZero: true,
                            ticks: { stepSize: 1, color: '#4B5563', font: { size: 13, family: 'Inter, sans-serif' } },
                            grid: { color: '#E5E7EB' }
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>
