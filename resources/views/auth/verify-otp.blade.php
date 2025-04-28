<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enter OTP</title>
</head>
<body>

    <h1>Enter OTP</h1>

    @if (session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <form action="{{ route('otp.verify') }}" method="POST">
        @csrf
        <input type="text" name="otp" placeholder="Enter your OTP">
        <button type="submit">Verify</button>
    </form>

    <br>

    <!-- Resend OTP Section -->
    <form id="resend-otp-form" action="{{ route('resend.otp') }}" method="GET" style="display: inline;">
        <button id="resend-otp-btn" type="submit" class="btn btn-link">Resend OTP</button>
    </form>

    <p id="countdown-text" style="display: none; color: gray; font-size: 14px;"></p>

    <!-- JavaScript Countdown -->
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const resendForm = document.getElementById('resend-otp-form');
        const resendButton = document.getElementById('resend-otp-btn');
        const countdownText = document.getElementById('countdown-text');
        let countdown;

        resendForm.addEventListener('submit', function (e) {
            // Start countdown after submitting the resend form
            startCountdown(60); // 60 seconds
        });

        function startCountdown(seconds) {
            resendButton.disabled = true;
            countdownText.style.display = 'inline';
            countdown = seconds;

            updateCountdown();

            const interval = setInterval(() => {
                countdown--;
                updateCountdown();

                if (countdown <= 0) {
                    clearInterval(interval);
                    resendButton.disabled = false;
                    countdownText.style.display = 'none';
                }
            }, 1000);
        }

        function updateCountdown() {
            countdownText.textContent = `You can resend OTP again in ${countdown} second${countdown !== 1 ? 's' : ''}...`;
        }
    });
    </script>

</body>
</html>
