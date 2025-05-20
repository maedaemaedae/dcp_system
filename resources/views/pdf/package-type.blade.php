<h2 style="text-align:center;">Package Contents</h2>
<table width="100%" border="1" cellspacing="0" cellpadding="5">
    <thead><tr><th>Item Name</th><th>Total Quantity</th></tr></thead>
    <tbody>
        @foreach ($packageChartData as $item)
            <tr><td>{{ $item->item_name }}</td><td>{{ $item->total_quantity }}</td></tr>
        @endforeach
    </tbody>
</table>
