<!DOCTYPE html>
<html>
<head>
    <title>Item Type Distribution Report</title>
    <style>
        body { font-family: Arial, sans-serif; }
        h2 { text-align: center; }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
        }
    </style>
</head>
<body>
    <h2>Total Items by Type</h2>
    <table>
        <thead>
            <tr>
                <th>Item Type</th>
                <th>Total Quantity</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($nameTotals as $item)
                <tr>
                    <td>{{ $item->item_name }}</td>
                    <td>{{ $item->total_quantity }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
