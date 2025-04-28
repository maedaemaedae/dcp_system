<!DOCTYPE html>
<html>
<head>
    <title>Verify OTP</title>
</head>
<body>
    <h1>Enter OTP</h1>

    @if(session('error'))
        <p style="color:red;">{{ session('error') }}</p>
    @endif

    <form method="POST" action="{{ route('otp.verify') }}">
        @csrf
        <input type="text" name="otp" placeholder="Enter your OTP" required>
        <button type="submit">Verify</button>
    </form>
</body>
</html>
