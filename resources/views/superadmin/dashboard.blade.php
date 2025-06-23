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
            <!-- Package Type Chart -->
            <div class="bg-white p-4 rounded shadow flex justify-center">
                <div>
                    <h2 class="text-lg font-semibold mb-2 text-center">Package Type Distribution</h2>
                    <canvas id="packageTypeChart" class="w-[350px] h-[350px]"></canvas>
                </div>
            </div>

            <!-- Schools per Division Chart -->
            <div class="bg-white p-4 rounded shadow flex justify-center">
                <div>
                    <h2 class="text-lg font-semibold mb-2 text-center">Schools per Division</h2>
                    <canvas id="regionChart" class="w-[350px] h-[350px]"></canvas>
                </div>
            </div>
        </div>

        <!-- Delivery Status Overview Donut Chart -->
        <div class="bg-white p-4 rounded shadow w-full md:w-1/2 mx-auto">
            <h2 class="text-lg font-semibold mb-2 text-center">Status Overview</h2>
            <canvas id="statusChart" class="w-[300px] h-[300px] mx-auto"></canvas>
            <div class="text-center text-sm text-gray-600 mt-4">
                <span class="inline-block w-3 h-3 rounded-sm bg-yellow-400 mr-2"></span> Pending: {{ $pending }}
                <span class="inline-block w-3 h-3 rounded-sm bg-orange-400 ml-4 mr-2"></span> Partial: {{ $partial }}
                <span class="inline-block w-3 h-3 rounded-sm bg-green-500 ml-4 mr-2"></span> Delivered: {{ $delivered }}
                <span class="inline-block w-3 h-3 rounded-sm bg-red-500 ml-4 mr-2"></span> Cancelled: {{ $cancelled }}
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Package Type Chart
            const packageTypeData = [
                @foreach ($packageTypeData as $pt)
                    { name: "{{ $pt->package_code }}", count: {{ $pt->packages_count }} },
                @endforeach
            ];

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
                    responsive: false,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });

            // Schools per Division Chart
            const regionData = [
                @foreach ($divisionSchoolCounts as $r)
                    { division: "{{ $r->division }}", total: {{ $r->total }} },
                @endforeach
            ];
            

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
                    responsive: false,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: { stepSize: 1 }
                        }
                    }
                }
            });

            // Delivery Status Donut Chart
            const ctx = document.getElementById('statusChart').getContext('2d');
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Pending', 'Partial', 'Delivered', 'Cancelled'],
                    datasets: [{
                        data: [{{ $pending }}, {{ $partial }}, {{ $delivered }}, {{ $cancelled }}],
                        backgroundColor: ['#FACC15', '#FB923C', '#22C55E', '#EF4444'],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: false,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'bottom' },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return `${context.label}: ${context.parsed}`;
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
    @endpush
</x-app-layout>
