<!DOCTYPE html>
<html>
<head>
    <title>Superadmin Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<h1 style="text-align: center;">Superadmin Dashboard</h1>

<form method="GET" action="{{ route('superadmin.dashboard') }}" style="text-align: center; margin-bottom: 30px;">
    <label for="chart_type">Select Chart Type:</label>
    <select name="chart_type" id="chart_type" onchange="this.form.submit()">
        <option value="item_type" {{ $chartType === 'item_type' ? 'selected' : '' }}>Item Type Distribution</option>
        <option value="package" {{ $chartType === 'package' ? 'selected' : '' }}>Package-based Distribution</option>
        <option value="project" {{ $chartType === 'project' ? 'selected' : '' }}>Project Distribution</option>
    </select>

    @if ($chartType === 'package')
        <br><br>
        <label for="package_type_id">Select Package Code:</label>
        <select name="package_type_id" id="package_type_id" onchange="this.form.submit()">
            <option value="">-- Choose Package --</option>
            @foreach ($packageTypes as $package)
                <option value="{{ $package->id }}" {{ $selectedPackageId == $package->id ? 'selected' : '' }}>
                    {{ $package->package_code }}
                </option>
            @endforeach
        </select>
    @endif

    @if ($chartType === 'project')
        <br><br>
        <label for="project_id">Select Project:</label>
        <select name="project_id" id="project_id" onchange="this.form.submit()">
            <option value="">-- Choose Project --</option>
            @foreach ($projects as $project)
                <option value="{{ $project->id }}" {{ $selectedProjectId == $project->id ? 'selected' : '' }}>
                    {{ $project->name }}
                </option>
            @endforeach
        </select>

        @if ($selectedProjectId)
            <br><br>
            <label for="project_view">View:</label>
            <select name="project_view" id="project_view" onchange="this.form.submit()">
                <option value="schools" {{ $projectView === 'schools' ? 'selected' : '' }}>Schools</option>
                <option value="packages" {{ $projectView === 'packages' ? 'selected' : '' }}>Packages</option>
            </select>
        @endif

        @if ($projectView === 'schools' && count($schools))
            <h3 style="text-align:center; margin-top: 30px;">Schools under this project</h3>
            <table border="1" style="margin: auto; width: 50%; text-align: center;">
                <thead><tr><th>School ID</th><th>School Name</th></tr></thead>
                <tbody>
                    @foreach ($schools as $school)
                        <tr><td>{{ $school->id }}</td><td>{{ $school->school_name }}</td></tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        @if ($projectView === 'packages' && count($projectChartData))
            @php
                $groupedData = $projectChartData->groupBy('package_code');
                $labels = $groupedData->keys();
                $data = $groupedData->map(fn($items) => $items->sum('total_quantity'))->values();
                $tooltipMap = $groupedData->map(function ($items) {
                    return $items->map(fn($i) => $i->item_name . ':' . $i->total_quantity)->implode(', ');
                });
            @endphp
            <div style="width: 600px; margin: auto;">
                <canvas id="donutProjectAllPackages"></canvas>
            </div>
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
                            title: { display: true, text: 'Package-wise Item Breakdown' },
                            legend: { position: 'bottom' }
                        }
                    }
                });
            </script>
        @endif
    @endif
</form>

@if ($chartType === 'item_type' && $nameTotals->count())
    <div style="width: 500px; margin: auto;">
        <canvas id="donutChartItemType"></canvas>
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
                    title: { display: true, text: 'Total Items by Type' }
                }
            }
        });
    </script>
@endif

@if ($chartType === 'package' && $selectedPackageId && count($packageChartData))
    <div style="width: 500px; margin: auto;">
        <canvas id="donutChartPackage"></canvas>
    </div>
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
                    title: { display: true, text: 'Item Distribution for Selected Package' }
                }
            }
        });
    </script>
@endif

</body>
</html>
