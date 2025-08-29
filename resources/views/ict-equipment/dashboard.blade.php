<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ICT Equipment Dashboard | DCP Tracking Hub</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>[x-cloak] { display: none !important; }</style>
</head>
<body class="bg-gray-50 font-['Poppins'] text-gray-800">
    <div class="max-w-6xl mx-auto py-10">
        <h2 class="text-4xl font-bold text-gray-800 mb-8 flex items-center gap-4">
            <i class="fa-solid fa-desktop text-blue-500 text-3xl"></i>
            ICT Equipment Dashboard
        </h2>

        <!-- Metric Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-6 mb-10">
            <a href="{{ route('ict-equipment.index') }}" class="bg-white rounded-xl shadow p-6 flex flex-col items-center hover:bg-blue-50 transition cursor-pointer">
                <span class="fa-solid fa-desktop text-2xl text-blue-500 mb-2"></span>
                <span class="text-lg font-semibold">Total Equipments</span>
                <span class="text-3xl font-bold mt-2">{{ $totalEquipments ?? 0 }}</span>
            </a>
            <a href="{{ route('ict-equipment.index', ['condition' => 'IN USE']) }}" class="bg-white rounded-xl shadow p-6 flex flex-col items-center hover:bg-green-50 transition cursor-pointer">
                <span class="fa-solid fa-check-circle text-2xl text-green-500 mb-2"></span>
                <span class="text-lg font-semibold">In Use</span>
                <span class="text-3xl font-bold mt-2">{{ $inUseCount ?? 0 }}</span>
            </a>
            <a href="{{ route('ict-equipment.index', ['condition' => 'FOR REPAIR']) }}" class="bg-white rounded-xl shadow p-6 flex flex-col items-center hover:bg-yellow-50 transition cursor-pointer">
                <span class="fa-solid fa-tools text-2xl text-yellow-500 mb-2"></span>
                <span class="text-lg font-semibold">For Repair</span>
                <span class="text-3xl font-bold mt-2">{{ $forRepairCount ?? 0 }}</span>
            </a>
            <a href="{{ route('ict-equipment.index', ['category' => 'laptop']) }}" class="bg-white rounded-xl shadow p-6 flex flex-col items-center hover:bg-indigo-50 transition cursor-pointer">
                <span class="fa-solid fa-laptop text-2xl text-indigo-500 mb-2"></span>
                <span class="text-lg font-semibold">Laptops</span>
                <span class="text-3xl font-bold mt-2">{{ $laptopCount ?? 0 }}</span>
            </a>
            <a href="{{ route('ict-equipment.index', ['category' => 'printer']) }}" class="bg-white rounded-xl shadow p-6 flex flex-col items-center hover:bg-pink-50 transition cursor-pointer">
                <span class="fa-solid fa-print text-2xl text-pink-500 mb-2"></span>
                <span class="text-lg font-semibold">Printers</span>
                <span class="text-3xl font-bold mt-2">{{ $printerCount ?? 0 }}</span>
            </a>
            <a href="{{ route('ict-equipment.index', ['category' => 'desktop']) }}" class="bg-white rounded-xl shadow p-6 flex flex-col items-center hover:bg-purple-50 transition cursor-pointer">
                <span class="fa-solid fa-desktop text-2xl text-purple-500 mb-2"></span>
                <span class="text-lg font-semibold">Desktops</span>
                <span class="text-3xl font-bold mt-2">{{ $desktopCount ?? 0 }}</span>
            </a>
        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Equipment by Category -->
            <div class="bg-white rounded-xl border border-gray-200 shadow p-6 h-[400px]">
                <h3 class="text-xl font-semibold mb-6 text-center text-gray-800">Equipment by Category</h3>
                <canvas id="categoryChart" class="w-full h-[320px]"></canvas>
            </div>
            <!-- Equipment by Location -->
            <div class="bg-white rounded-xl border border-gray-200 shadow p-6 h-[400px]">
                <h3 class="text-xl font-semibold mb-6 text-center text-gray-800">Equipment by Location</h3>
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
