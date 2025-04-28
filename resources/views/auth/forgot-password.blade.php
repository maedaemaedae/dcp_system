<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Forgot Password | DCP Tracking Hub</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>


<body class="bg-[#EFEFEF] text-gray-800 min-h-screen flex items-center justify-center px-4">
    <!-- ✅ Navigation Bar -->
    <nav class="fixed top-0 left-0 right-0 z-50 bg-white shadow-lg">


        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex-shrink-0">
                    <a href=<a href="/">
                   
                        <img src="{{ asset('images/landscape-logo.png') }}" alt="YourLogo" class="h-14 w-auto">
                    </a>
                </div>      
            </div>
        </div>
    </nav>


  <div class="max-w-md w-full bg-white shadow-lg rounded-2xl p-8 space-y-6">
   
    <!-- Exclamation Icon (Now an Image) -->
<div class="flex justify-center">
  <div class="p-3 rounded-full bg-white">
    <img src="{{ ('images/exclamation.png') }}" class="h-12 w-12 object-contain" />
  </div>
</div>
  <!-- Title -->
  <h2 class="text-center text-2xl font-bold text-gray-800">Forgot Password</h2>
    <p class="text-center text-gray-600 text-sm">Enter your email and we'll send you instructions to reset your password.</p>


    <!-- Email Input -->
    <form action="{{ route('password.email') }}" method="POST" class="space-y-4">
      @csrf
      <div>
        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email address</label>
        <input type="email" name="email" id="email" required
               class="w-full border border-gray-300 rounded-md px-4 py-2 focus:ring-2 focus:ring-[#2D9CDB] focus:outline-none" />
      </div>


      <!-- Reset Password Button -->
      <div>
        <button type="submit"
                class="w-full bg-[#2D9CDB] hover:bg-[#238ACB] text-white font-semibold py-2 rounded-md transition">
          Reset Password
        </button>
      </div>
    </form>


    <!-- Back to Login -->
    <div class="text-center">
      <a href="{{ route('login') }}" class="text-[#2D9CDB] hover:text-[#238ACB] text-sm font-medium transition">Back to Login</a>
    </div>
  </div>


</body>
</html>
