<!DOCTYPE html>
<html>
<head>
    <title>Item Quantity Donut Chart</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

    <h2 style="text-align: center;">Total Items by Type</h2>
    <div style="width: 500px; margin: auto;">
        <canvas id="donutChart"></canvas>
    </div>

    <script>
        const ctx = document.getElementById('donutChart').getContext('2d');

        const data = {
            labels: {!! json_encode($nameTotals->pluck('item_name')) !!},
            datasets: [{
                label: 'Total Quantity',
                data: {!! json_encode($nameTotals->pluck('total_quantity')) !!},
                backgroundColor: [
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(255, 206, 86, 0.6)',
                    'rgba(75, 192, 192, 0.6)',
                    'rgba(153, 102, 255, 0.6)',
                    'rgba(255, 159, 64, 0.6)',
                    'rgba(201, 203, 207, 0.6)'
                ],
                borderColor: 'rgba(255, 255, 255, 1)',
                borderWidth: 1
            }]
        };

        const config = {
            type: 'doughnut',
            data: data,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    },
                    title: {
                        display: true,
                        text: 'Item Distribution by Type'
                    }
                }
            }
        };

        new Chart(ctx, config);
    </script>

</body>
</html>
