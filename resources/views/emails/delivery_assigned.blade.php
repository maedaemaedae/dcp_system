<html>
<body>
    <h2>New Delivery Assignment</h2>
    <p>Hello, you have been assigned a new delivery.</p>
    <p><strong>Recipient:</strong> {{ $delivery->recipient->contact_person ?? 'N/A' }}</p>
    <p><strong>Package:</strong> {{ $delivery->recipient->package->packageType->package_code ?? 'N/A' }}</p>
    <p><strong>Quantity:</strong> {{ $delivery->quantity ?? 'N/A' }}</p>
    <p><strong>Status:</strong> {{ $delivery->status }}</p>
    <p><strong>Target Delivery:</strong> {{ $delivery->target_delivery }}</p>
    <p>
        <a href="{{ url('/supplier/deliveries') }}" style="display:inline-block;padding:10px 20px;background:#2563eb;color:#fff;text-decoration:none;border-radius:4px;">View Deliveries</a>
    </p>
</body>
</html>
