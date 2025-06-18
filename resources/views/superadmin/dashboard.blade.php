<x-app-layout>
    <div class="p-6 space-y-6">
        <!-- Header -->
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-semibold text-gray-800">Superadmin Dashboard</h1>
            <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Export CSV</button>
        </div>

        <!-- Metric Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-6">
            <x-dashboard.card title="Total Schools" :value="$schoolCount ?? 0" icon="school" />
            <x-dashboard.card title="Total Recipients" :value="$recipientCount ?? 0" icon="users" />
            <x-dashboard.card title="Delivered Items" :value="$deliveredItemCount ?? 0" icon="box" />
            <x-dashboard.card title="Pending Deliveries" :value="$pendingDeliveries ?? 0" icon="clock" />
            <x-dashboard.card title="Delivered Packages" :value="$deliveredPackages ?? 0" icon="check-circle" />
        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white p-4 rounded shadow">
                <h2 class="text-lg font-semibold mb-2">Package Type Distribution</h2>
                <canvas id="packageTypeChart" class="w-full h-64"></canvas>
            </div>

            <div class="bg-white p-4 rounded shadow">
                <h2 class="text-lg font-semibold mb-2">Schools per Division</h2>
                <canvas id="regionChart" class="w-full h-64"></canvas>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            try {
                const packageTypeData = [
                    @foreach ($packageTypeData as $pt)
                        { name: "{{ $pt->package_code }}", packages_count: {{ $pt->packages_count }} },
                    @endforeach
                ];

                const regionData = [
                    @foreach ($divisionSchoolCounts as $r)
                        { division: "{{ $r->division }}", total: {{ $r->total }} },
                    @endforeach
                ];

                new Chart(document.getElementById('packageTypeChart'), {
                    type: 'doughnut',
                    data: {
                        labels: packageTypeData.map(pt => pt.name),
                        datasets: [{
                            label: 'Package Count',
                            data: packageTypeData.map(pt => pt.packages_count),
                            backgroundColor: ['#4F46E5', '#16A34A', '#F59E0B', '#EF4444'],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }
                });

                new Chart(document.getElementById('regionChart'), {
                    type: 'bar',
                    data: {
                        labels: regionData.map(r => r.division),
                        datasets: [{
                            label: 'Number of Schools',
                            data: regionData.map(r => r.total),
                            backgroundColor: '#3B82F6'
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: { stepSize: 1 }
                            }
                        }
                    }
                });

            } catch (error) {
                console.error("Error rendering charts:", error);
            }
        });
    </script>
    @endpush
</x-app-layout>
