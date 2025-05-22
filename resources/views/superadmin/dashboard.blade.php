<!DOCTYPE html>
<html>
<head>
    <title>Superadmin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>
     

       <!-- Google Fonts: Poppins -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>
<body class="bg-white text-gray-900">

     <!-- Side Bar -->
    @include('layouts.sidebar')

      <!-- Top Nav Bar -->
    @include('layouts.top-navbar')

 <!-- Sample Dashboard Content Area -->
            <main :class="open ? 'ml-72' : 'ml-20'" class="transition-all duration-300 top-24 p-8 relative">
            <h2 class="text-[45px] font-bold text-gray-800 dark:text-white mb-6 border-b border-gray-300 dark:border-gray-600 pb-2 tracking-wide">
                📊 Superadmin Dashboard
            </h2>

<div class="max-w-6xl mx-auto px-6 mt-6 mb-12">
    <div class="flex flex-col md:flex-row md:items-center gap-6 bg-white shadow-md rounded-xl p-6 border border-gray-200">
        
        {{-- Chart Type Selector --}}
        <form method="GET" action="{{ route('superadmin.dashboard') }}" class="flex flex-col md:flex-row md:items-center gap-4 w-full">
            <div>
                <label for="chart_type" class="block text-sm font-semibold text-gray-700 mb-1">📊 Select Chart Type</label>
                <select name="chart_type" id="chart_type" onchange="this.form.submit()"
                        class="border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none rounded-lg px-4 py-2 text-sm bg-white shadow-sm transition">
                    <option value="item_type" {{ $chartType === 'item_type' ? 'selected' : '' }}>Item Type Distribution</option>
                    <option value="package" {{ $chartType === 'package' ? 'selected' : '' }}>Package-based Distribution</option>
                    <option value="project" {{ $chartType === 'project' ? 'selected' : '' }}>Project Distribution</option>
                </select>
            </div>

            {{-- Package Code Selector (if chartType === package) --}}
            @if ($chartType === 'package')
                <div>
                    <label for="package_type_id" class="block text-sm font-semibold text-gray-700 mb-1">📦 Select Package Code</label>
                    <select name="package_type_id" id="package_type_id" onchange="this.form.submit()"
                            class="border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none rounded-lg px-4 py-2 text-sm bg-white shadow-sm transition">
                        <option value="">-- Choose Package --</option>
                        @foreach ($packageTypes as $package)
                            <option value="{{ $package->id }}" {{ $selectedPackageId == $package->id ? 'selected' : '' }}>
                                {{ $package->package_code }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endif

            {{-- Project Selector (if chartType === project) --}}
            @if ($chartType === 'project')
                <div>
                    <label for="project_id" class="block text-sm font-semibold text-gray-700 mb-1">🏗️ Select Project</label>
                    <select name="project_id" id="project_id" onchange="this.form.submit()"
                            class="border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none rounded-lg px-4 py-2 text-sm bg-white shadow-sm transition">
                        <option value="">-- Choose Project --</option>
                        @foreach ($projects as $project)
                            <option value="{{ $project->id }}" {{ $selectedProjectId == $project->id ? 'selected' : '' }}>
                                {{ $project->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- View Options (if project selected) --}}
                @if ($selectedProjectId)
                    <div>
                        <label for="project_view" class="block text-sm font-semibold text-gray-700 mb-1">👁️ View</label>
                        <select name="project_view" id="project_view" onchange="this.form.submit()"
                                class="border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none rounded-lg px-4 py-2 text-sm bg-white shadow-sm transition">
                            <option value="schools" {{ $projectView === 'schools' ? 'selected' : '' }}>Schools</option>
                            <option value="packages" {{ $projectView === 'packages' ? 'selected' : '' }}>Packages</option>
                        </select>
                    </div>
                @endif
            @endif
        </form>
    </div>

    {{-- Display schools table if schools view is active --}}
    @if ($chartType === 'project' && $projectView === 'schools' && count($schools))
        <h2 class="text-2xl font-bold text-center mt-10 mb-4">Schools under this project</h2>
        <div class="overflow-x-auto">
                <div class="w-full overflow-x-auto bg-white rounded-2xl shadow border">
                <table class="min-w-full text-sm divide-y divide-gray-200">
                    <thead class="bg-[#4A90E2] text-white">
                    <tr>
                        <th class="border border-gray-300 px-4 py-2">School ID</th>
                        <th class="border border-gray-300 px-4 py-2">School Name</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($schools as $school)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $school->id }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $school->school_name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>


</form>



<!-- Total Items by Type -->

 {{-- Item Type Distribution --}}
@if ($chartType === 'item_type' && $nameTotals->count())
    <div class="max-w-4xl mx-auto px-6 my-12">
    <div class="bg-gradient-to-r from-white via-gray-50 to-white shadow-2xl rounded-2xl p-8 border border-gray-200 hover:shadow-blue-100 transition-shadow duration-300">
        <h2 class="text-2xl font-semibold text-gray-800 text-center mb-6 tracking-tight">Total Items by Type</h2>

        <div class="flex justify-center items-center w-full h-[400px] bg-white rounded-xl shadow-inner border border-gray-100">
            <canvas id="donutChartItemType" class="w-[350px] h-[350px]"></canvas>
        </div>
    </div>
</div>

    <script>
        new Chart(document.getElementById('donutChartItemType'), {
            type: 'doughnut',
            data: {
                labels: @json($nameTotals->pluck('item_name')),
                datasets: [{
                    label: 'Total Quantity',
                    data: @json($nameTotals->pluck('total_quantity')),
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.6)', 'rgba(54, 162, 235, 0.6)',
                        'rgba(255, 206, 86, 0.6)', 'rgba(75, 192, 192, 0.6)',
                        'rgba(153, 102, 255, 0.6)', 'rgba(255, 159, 64, 0.6)'
                    ],
                    borderColor: 'white',
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    legend: { position: 'bottom' },
                    title: { display: true}
                }
            }
        });
    </script>
@endif

@if ($chartType === 'item_type')
    <form action="{{ route('superadmin.chart.pdf') }}" method="GET" target="_blank" class="text-center mt-5">
        <input type="hidden" name="chart_type" value="item_type">
      <div class="flex justify-center mt-10">
  <button type="submit" class="flex items-center justify-center gap-2 bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 text-white font-semibold px-6 py-3 rounded-lg shadow-md transition-transform duration-200 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500">
    <!-- Download icon SVG -->
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5m0 0l5-5m-5 5V4" />
    </svg>
    Download CSV Report
  </button>
</div>


    </form>
@endif



<!-- Item Distribution for Selected Package -->

 {{-- Package-based Distribution --}}

@if ($chartType === 'package' && $selectedPackageId && count($packageChartData))
   <div class="max-w-4xl mx-auto px-6 my-12">
    <div class="bg-gradient-to-r from-white via-gray-50 to-white shadow-2xl rounded-2xl p-8 border border-gray-200 hover:shadow-blue-100 transition-shadow duration-300">
        <h2 class="text-2xl font-semibold text-gray-800 text-center mb-6 tracking-tight">Item Distribution for Selected Package</h2>
        
        <div class="flex justify-center items-center w-full h-[400px] bg-white rounded-xl shadow-inner border border-gray-100">
            <canvas id="donutChartPackage" class="w-[350px] h-[350px]"></canvas>
        </div>
    </div>
</div>

    {{-- Scripts --}}
    <script>
        new Chart(document.getElementById('donutChartPackage'), {
            type: 'doughnut',
            data: {
                labels: @json($packageChartData->pluck('item_name')),
                datasets: [{
                    label: 'Total Quantity',
                    data: @json($packageChartData->pluck('total_quantity')),
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.6)', 'rgba(54, 162, 235, 0.6)',
                        'rgba(255, 206, 86, 0.6)', 'rgba(75, 192, 192, 0.6)',
                        'rgba(153, 102, 255, 0.6)', 'rgba(255, 159, 64, 0.6)'
                    ],
                    borderColor: 'white',
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    legend: { position: 'bottom' },
                    title: { display: true,}
                }
            }
        });
    </script>
    <form action="{{ route('superadmin.chart.pdf') }}" method="GET" target="_blank" class="text-center mt-5">
        <input type="hidden" name="chart_type" value="{{ $chartType }}">
        @if ($chartType === 'package')
            <input type="hidden" name="package_type_id" value="{{ $selectedPackageId }}">
        @endif
        @if ($chartType === 'project')
            <input type="hidden" name="project_id" value="{{ $selectedProjectId }}">
            <input type="hidden" name="project_view" value="{{ $projectView }}">
        @endif
       <div class="flex justify-center mt-10">
  <button type="submit" class="flex items-center justify-center gap-2 bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 text-white font-semibold px-6 py-3 rounded-lg shadow-md transition-transform duration-200 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500">
    <!-- Download icon SVG -->
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5m0 0l5-5m-5 5V4" />
    </svg>
    Download CSV Report
  </button>
</div>

    </form>
@endif



<!-- Project Package Overview -->
@if ($projectView === 'packages' && count($projectChartData))
    @php
        $groupedData = $projectChartData->groupBy('package_code');
        $labels = $groupedData->keys();
        $data = $groupedData->map(fn($items) => $items->sum('total_quantity'))->values();
        $tooltipMap = $groupedData->map(function ($items) {
            return $items->map(fn($i) => $i->item_name . ':' . $i->total_quantity)->implode(', ');
        });
    @endphp

    <div class="max-w-3xl mx-auto mt-12">
    <h2 class="text-2xl font-semibold text-center mb-6">📦 Project Package Overview</h2>
    <div class="flex flex-col md:flex-row justify-center items-start gap-20">

           {{-- Package-wise Chart --}}
        <div class="flex-1 bg-white rounded-2xl shadow-lg p-6 border border-gray-200">
            <h3 class="text-lg font-semibold text-center mb-4 text-gray-800">Item Distribution per Package</h3>
            <div class="flex justify-center">
                <canvas id="donutProjectAllPackages" class="w-[350px] h-[350px]"></canvas>
            </div>
        </div>

             {{-- Delivery Status Chart --}}
            @if ($deliveryStatusCounts->count())
                <div 
                    class="flex-1 bg-white rounded-2xl shadow-lg p-6 border border-gray-200 cursor-pointer hover:shadow-xl transition-shadow"
                    onclick="window.location.href='{{ route('deliveries.index') }}'"
                    title="Go to Deliveries Page"
                >
                    <h3 class="text-lg font-semibold text-center mb-4 text-gray-800">Delivery Status Overview</h3>
                    <div class="flex justify-center">
                        <canvas id="deliveryStatusChart" class="w-[350px] h-[350px]"></canvas>
                    </div>
                </div>
            @endif


    </div>
</div>

    {{-- Scripts --}}
    <script>
        const ctx = document.getElementById('donutProjectAllPackages').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: @json($labels),
                datasets: [{
                    data: @json($data),
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.6)', 'rgba(54, 162, 235, 0.6)',
                        'rgba(255, 206, 86, 0.6)', 'rgba(75, 192, 192, 0.6)',
                        'rgba(153, 102, 255, 0.6)', 'rgba(255, 159, 64, 0.6)'
                    ],
                    borderColor: 'white',
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(ctx) {
                                const code = ctx.label;
                                const breakdown = @json($tooltipMap);
                                return `${code} → ${breakdown[code]}`;
                            }
                        }
                    },
                    title: { display: false },
                    legend: { position: 'bottom' }
                }
            }
        });

        const ctxStatus = document.getElementById('deliveryStatusChart').getContext('2d');
        new Chart(ctxStatus, {
            type: 'doughnut',
            data: {
                labels: @json($deliveryStatusCounts->keys()),
                datasets: [{
                    label: 'Delivery Status',
                    data: @json($deliveryStatusCounts->values()),
                    backgroundColor: [
                        'rgba(255, 205, 86, 0.6)', // Pending
                        'rgba(54, 162, 235, 0.6)', // In Transit
                        'rgba(75, 192, 192, 0.6)'  // Delivered
                    ],
                    borderColor: 'white',
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    legend: { position: 'bottom' },
                    title: { display: false }
                }
            }
        });
    </script>
@endif


</body>
</html>

