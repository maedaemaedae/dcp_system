<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard | DCP Tracking Hub</title>
     <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>


    <style>[x-cloak] { display: none !important; }</style>

</head>
<body class="bg-white font-['Poppins']" x-data="{ contentVisible: false }" x-init="setTimeout(() => contentVisible = true, 100)">

    <div class="flex">

         
            @include('layouts.sidebar') 
       

        <div class="fixed top-0 left-[300px] right-0 bg-white shadow-md h-20 z-10 transition-all duration-300" :class="open ? 'left-[300px]' : 'left-20'">
            @include('layouts.top-navbar') 
            <div class="flex items-center justify-between h-full px-8">
                
        </div>

    <main  :class="open ? 'ml-[5px]' : 'ml-5'" class="transition-all duration-300 p-8 pb-40 relative flex-1 overflow-y-auto h-[calc(100vh-5rem)]" x-show="contentVisible" x-transition.opacity.duration.500ms x-cloak>

    <div class="max-w-6xl mx-auto">
        <h2 class="text-[42px] font-bold text-gray-800 dark:text-white mb-6 border-b border-gray-300 dark:border-gray-600 pb-2 tracking-wide flex items-center gap-4">
             <i class="fa-solid fa-gauge-high text-blue-500 text-4xl w-10 h-10"></i>
            Superadmin Dashboard
        </h2>

        <!-- 📊 Modern Metric Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4">
    <x-dashboard.card title="Total Schools" :value="$schoolCount ?? 0" icon="school" />
    <x-dashboard.card title="Total Recipients" :value="$recipientCount ?? 0" icon="users" />
    <x-dashboard.card title="Delivered Items" :value="$deliveredItemCount ?? 0" icon="box" />
    <x-dashboard.card title="Pending Deliveries" :value="$pending ?? 0" icon="clock" />
    <x-dashboard.card title="Delivered Packages" :value="$delivered ?? 0" icon="check-circle" />
    <x-dashboard.card title="Cancelled Deliveries" :value="$cancelled ?? 0" icon="ban" />
</div>


<!-- 📈 Charts Section -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">

    <!-- 🏫 Schools per Division Chart -->
    <div class="bg-white rounded-xl border border-gray-200 shadow p-6 hover:shadow-md transition-all duration-300 h-[500px]">
        <h2 class="text-xl font-semibold mb-6 text-center text-gray-800">Schools per Division</h2>
        <div class="w-full h-[420px] relative">
            <canvas id="regionChart" class="absolute inset-0"></canvas>
        </div>
    </div>

    <!-- 🚚 Delivery Status Overview Donut Chart -->
    <div class="bg-white/80 backdrop-blur-md rounded-2xl border border-gray-200 shadow-md p-6 hover:shadow-lg transition-all duration-300 h-[500px] flex flex-col justify-between">
        <h2 class="text-xl font-semibold text-center text-gray-800 tracking-wide mb-2">Delivery Status Overview</h2>
        
        <div class="flex justify-center">
            <div class="w-full max-w-[300px]" style="aspect-ratio: 1 / 1;">
                <canvas id="statusChart" class="w-full h-full"></canvas>
            </div>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-4 gap-y-3 text-sm text-gray-700 text-center mt-4">
            <div class="flex flex-col items-center">
                <span class="inline-block w-3 h-3 rounded-full mb-1" style="background-color: #FACC15;"></span>
                <span class="font-medium">Pending</span>
                <span class="text-xs text-gray-500">{{ $pending }}</span>
            </div>
            <div class="flex flex-col items-center">
                <span class="inline-block w-3 h-3 rounded-full mb-1" style="background-color: #FB923C;"></span>
                <span class="font-medium">Partial</span>
                <span class="text-xs text-gray-500">{{ $partial }}</span>
            </div>
            <div class="flex flex-col items-center">
                <span class="inline-block w-3 h-3 rounded-full mb-1" style="background-color: #22C55E;"></span>
                <span class="font-medium">Delivered</span>
                <span class="text-xs text-gray-500">{{ $delivered }}</span>
            </div>
            <div class="flex flex-col items-center">
                <span class="inline-block w-3 h-3 rounded-full mb-1" style="background-color: #EF4444;"></span>
                <span class="font-medium">Cancelled</span>
                <span class="text-xs text-gray-500">{{ $cancelled }}</span>
            </div>
        </div>
    </div>

</div>


    </div>
</main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const packageTypeData = [
                @foreach ($packageTypeData as $pt)
                    { name: "{{ $pt->package_code }}", count: {{ $pt->packages_count }} },
                @endforeach
            ];

            // Make this chart responsive as well if you use it
            if (document.getElementById('packageTypeChart')) {
                new Chart(document.getElementById('packageTypeChart'), {
                    type: 'doughnut',
                    data: {
                        labels: packageTypeData.map(p => p.name),
                        datasets: [{
                            label: 'Package Count',
                            data: packageTypeData.map(p => p.count),
                            backgroundColor: ['#4F46E5', '#16A34A', '#F59E0B', '#EF4444', '#3B82F6', '#A855F7'],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true,
                        aspectRatio: 1.5,
                        plugins: {
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }
                });
            }

            const regionData = [
    @foreach ($divisionSchoolCounts as $r)
        { division: "{{ $r->division }}", total: {{ $r->total }} },
    @endforeach
];

const regionCtx = document.getElementById('regionChart').getContext('2d');

// Create vertical gradient
const regionGradient = regionCtx.createLinearGradient(0, 0, 0, 400);
regionGradient.addColorStop(0, '#60A5FA'); // blue-400
regionGradient.addColorStop(1, '#3B82F6'); // blue-500

new Chart(regionCtx, {
    type: 'bar',
    data: {
        labels: regionData.map(r => r.division),
        datasets: [{
            label: 'Number of Schools',
            data: regionData.map(r => r.total),
            backgroundColor: regionGradient,
            borderRadius: 8,
            barThickness: 30,
            maxBarThickness: 40,
            hoverBackgroundColor: '#2563EB',
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        layout: {
            padding: {
                top: 20,
                left: 10,
                right: 10,
                bottom: 10
            }
        },
        scales: {
            x: {
                ticks: {
                    color: '#4B5563',
                    font: {
                        size: 13,
                        weight: '500',
                        family: 'Inter, sans-serif'
                    }
                },
                grid: {
                    display: false
                }
            },
            y: {
                beginAtZero: true,
                ticks: {
                    stepSize: 1,
                    color: '#4B5563',
                    font: {
                        size: 13,
                        family: 'Inter, sans-serif'
                    }
                },
                grid: {
                    color: '#E5E7EB'
                }
            }
        },
        plugins: {
            legend: {
                display: false
            },
            tooltip: {
                backgroundColor: '#1F2937',
                titleColor: '#F9FAFB',
                bodyColor: '#E5E7EB',
                titleFont: {
                    size: 14,
                    weight: '600',
                    family: 'Inter, sans-serif'
                },
                bodyFont: {
                    size: 13,
                    family: 'Inter, sans-serif'
                },
                padding: 10,
                borderColor: '#4B5563',
                borderWidth: 1
            }
        },
        animation: {
            duration: 1000,
            easing: 'easeOutQuart'
        }
    }
});



        });
    </script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const statusCtx = document.getElementById('statusChart').getContext('2d');

        new Chart(statusCtx, {
            type: 'doughnut',
            data: {
                labels: ['Pending', 'Partial', 'Delivered', 'Cancelled'],
                datasets: [{
                    data: [{{ $pending }}, {{ $partial }}, {{ $delivered }}, {{ $cancelled }}],
                    backgroundColor: ['#FACC15', '#FB923C', '#22C55E', '#EF4444'],
                    borderWidth: 0,
                    borderColor: '#ffffff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                aspectRatio: 1,
                cutout: '65%',
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                return `${context.label}: ${context.parsed}`;
                            }
                        }
                    },
                    datalabels: {
                        color: '#374151',
                        font: {
                            weight: 'bold',
                            size: 14
                        },
                        formatter: (value, ctx) => {
                            if (value === 0) return '';
                            const sum = ctx.chart._metasets[0].total;
                            const percent = ((value / sum) * 100).toFixed(0) + '%';
                            return percent;
                        }
                    }
                }
            },
            plugins: [ChartDataLabels]
        });

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
    });
</script>


</body>
</html>
