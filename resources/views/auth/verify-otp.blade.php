<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enter OTP</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

    <div class="bg-white shadow-lg rounded-xl p-8 max-w-md w-full">
        <h1 class="text-2xl font-semibold text-center text-gray-800 mb-6">Enter OTP</h1>

        @if (session('error'))
            <p class="text-red-600 text-sm mb-4">{{ session('error') }}</p>
        @endif

        @if (session('success'))
            <p class="text-green-600 text-sm mb-4">{{ session('success') }}</p>
        @endif

        <form action="{{ route('otp.verify') }}" method="POST" class="mb-4">
            @csrf
            <input 
                type="text" 
                name="otp" 
                placeholder="Enter your OTP"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 mb-4"
                required
            >
            <button 
                type="submit"
                class="w-full bg-[#4A90E2] hover:bg-[#357ABD] text-white font-medium py-2 px-4 rounded-md transition duration-200"
            >
                Verify
            </button>
        </form>

        <!-- Resend OTP Section -->
        <form id="resend-otp-form" action="{{ route('resend.otp') }}" method="GET" class="text-center">
            <button 
                id="resend-otp-btn" 
                type="submit" 
                class="text-[#4A90E2] hover:text-[#357ABD] text-sm font-semibold transition"
            >
                Resend OTP
            </button>
        </form>

        <p id="countdown-text" class="text-gray-500 text-sm mt-2 text-center hidden"></p>
    </div>

    <!-- JavaScript Countdown -->
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const resendForm = document.getElementById('resend-otp-form');
        const resendButton = document.getElementById('resend-otp-btn');
        const countdownText = document.getElementById('countdown-text');
        let countdown;

        resendForm.addEventListener('submit', function (e) {
            startCountdown(60); // 60 seconds
        });

        function startCountdown(seconds) {
            resendButton.disabled = true;
            countdownText.classList.remove('hidden');
            countdown = seconds;

            updateCountdown();

            const interval = setInterval(() => {
                countdown--;
                updateCountdown();

                if (countdown <= 0) {
                    clearInterval(interval);
                    resendButton.disabled = false;
                    countdownText.classList.add('hidden');
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
