<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DCP Tracking System</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/new-portrait-logo.png') }}" type="image/png">

    <!-- TailwindCSS & Swiper -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unpkg.com/swiper@11/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper@11/swiper-bundle.min.js"></script>

     <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet" />
        

    <!-- Alpine.js -->
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>


    <style>
    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-6px); }
        75% { transform: translateX(6px); }
    }
    .shake {
        animation: shake 0.4s ease-in-out;
    }
</style>

<script>
    window.addEventListener('DOMContentLoaded', () => {
        const swiper = new Swiper('.mySwiper', {
            loop: true,
            autoplay: {
                delay: 3500,
                disableOnInteraction: false,
            },
            speed: 1000,
        });
    });


//Onclick Toggle Password 
      
            function togglePassword() {
                const input = document.getElementById("password");
                const icon = document.getElementById("eyeIcon");

                if (input.type === "password") {
                    input.type = "text";
                    icon.innerHTML = `
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.964 9.964 0 012.206-3.592m1.591-1.41A9.965 9.965 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.97 9.97 0 01-4.293 5.202M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 3l18 18" />
                    `;
                } else {
                    input.type = "password";
                    icon.innerHTML = `
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    `;
                }
            }
        </script>    
</head>

<body class="font-poppins text-gray-900 antialiased bg-gray-100">
    <div class="flex items-center justify-center min-h-screen w-full relative">

        @include('components.back-home')

        {{-- Laravel error alert --}}
        @if ($errors->has('email'))
            <div 
                x-data="{ show: true }" 
                x-show="show" 
                x-transition 
                class="absolute top-5 left-1/2 transform -translate-x-1/2 z-50 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded shadow-md w-[90%] max-w-md"
                role="alert"
            >
                <div class="flex justify-between items-center">
                    <span class="text-sm font-medium">{{ $errors->first('email') }}</span>
                    <button @click="show = false" class="text-red-500 hover:text-red-700 text-xl font-bold leading-none">&times;</button>
                </div>
            </div>
        @endif

        <!-- Single centered card with conditional shake -->
        <div class="w-[799px] h-[550px] bg-white relative overflow-hidden mx-auto {{ $errors->has('email') ? 'shake' : '' }}">
            <!-- KEEP your existing login content inside here -->


           <!-- Right Side: Image Carousel -->
                <div class="w-96 h-[550px] left-[420px] top-0 absolute rounded-tl-[40px] rounded-bl-[40px] overflow-hidden">
                    <div class="swiper mySwiper h-full">
                        <div class="swiper-wrapper h-full">
                            <!-- Slide 1 -->
                            <div class="swiper-slide">
                                <img src="{{ asset('images/login-mockups2.png') }}" class="w-full h-full object-cover" />
                            </div>
                            <!-- Slide 2 -->
                            <div class="swiper-slide">
                                <img src="https://placehold.co/400x550?text=420x550" class="w-full h-full object-cover" />
                            </div>
                            <!-- Slide 3 -->
                            <div class="swiper-slide">
                                <img src="https://placehold.co/400x550?text=420x550" class="w-full h-full object-cover" />
                            </div>
                        </div>
                    </div>
                </div>


            <!-- Form Side — NOW on the LEFT -->
            <!-- LOGO -->
            <img class="w-28 h-28 absolute top-6 left-6 z-10" src="{{ asset('images/portrait-logo.png') }}" alt="DCP Logo" />

            <!-- Header -->
            <div class="w-96 left-[33px] top-[129px] absolute inline-flex flex-col justify-start items-start">
                <div class="self-stretch justify-center text-[#100F14] text-2xl font-semibold font-['Poppins'] leading-10">
                    Welcome to DCP
                </div>
                <div class="self-stretch justify-center text-[#49475A] text-xs font-normal font-['Poppins'] leading-normal tracking-tight">
                    Kindly fill in your details below to Login to your account
                </div>
            </div>

            <!-- Form -->
            <form id="loginForm" method="POST" action="{{ route('login') }}" class="flex flex-col">
                @csrf
               <!-- Email Address -->
                <div class="w-80 left-[33px] top-[220px] absolute inline-flex flex-col justify-start items-start">
                <label class="w-80 text-gray-600 text-xs font-medium font-['Poppins'] leading-normal">Email</label>
                <div class="relative w-full">
                    <div class="absolute left-3 top-2.5 text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5.121 17.804A8.966 8.966 0 0112 15c2.403 0 4.58.947 6.121 2.804M15 11a3 3 0 10-6 0 3 3 0 006 0z" />
                        </svg>
                    </div>

                    @php
                        $emailError = $errors->first('email');
                    @endphp

                   <input type="text" id="email" name="email" required
                    value="{{ old('email') }}"
                    class="w-80 h-10 px-10 py-1 bg-white rounded-md border 
                    text-gray-600 text-[10px] font-medium font-['Poppins'] leading-normal focus:outline-none focus:ring-2 focus:ring-[#4A90E2] focus:border-[#4A90E2]
                    {{ $emailError && !Str::contains($emailError, ['credentials', 'password']) ? 'border-red-500' : 'border-gray-300' }}"
                    placeholder="Enter your email" />


                        <p id="emailError" class="text-red-500 text-xs mt-1 hidden">Invalid email address</p>
                       
                </div>
            </div>

               <!-- Password Input -->
                <div class="w-80 left-[33px] top-[315px] absolute inline-flex flex-col justify-start items-start">
                    <label class="w-80 text-gray-600 text-xs font-medium font-['Poppins'] leading-normal">Password</label>
                    <div class="relative w-full">
                        <input type="password"
                            required
                            placeholder="Enter your password"
                            id="password"
                            name="password"
                            class="w-80 h-10 px-10 py-1 pr-10 bg-white rounded-md border border-gray-300 text-gray-600 text-[10px] font-medium font-['Poppins'] leading-normal focus:outline-none focus:ring-2 focus:ring-[#4A90E2] focus:border-[#4A90E2]
                            @error('email') border-red-500 @enderror"/>

                            <!-- Show custom Laravel error when email exists but password is wrong -->
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror

             
         
<script>
    document.getElementById("loginForm").addEventListener("submit", function (e) {
        let isValid = true;

        const emailInput = document.getElementById("email");
        const email = emailInput.value.trim();
        const password = document.getElementById("password").value.trim();
        const emailError = document.getElementById("emailError");

        // Reset states
        emailError.classList.add("hidden");
        emailInput.classList.remove("border-red-500");

        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            emailError.textContent = "Invalid email address";
            emailError.classList.remove("hidden");
            emailInput.classList.add("border-red-500"); // Highlight border
            isValid = false;
        }

        if (password.length < 6) {
            alert("Password must be at least 6 characters.");
            isValid = false;
        }

        if (!isValid) {
            e.preventDefault();
        }
    });
</script>



        <!-- Lock icon -->
        <div class="absolute left-3 top-2.5 text-gray-400">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 11c.552 0 1 .448 1 1v1h-2v-1c0-.552.448-1 1-1zm6 0V9a6 6 0 10-12 0v2H4v10h16V11h-2zm-2 0H8V9a4 4 0 118 0v2z" />
            </svg>
        </div>

        <!-- Toggle Eye icon -->
        <button type="button" onclick="togglePassword()" class="absolute right-3 top-2 text-gray-400">
            <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            </svg>
        </button>


        <!-- Remember Me -->
        <div class="w-full flex justify-between items-center mt-2">
            <label class="flex items-center text-gray-600 text-xs font-normal font-['Poppins']">
                <input type="checkbox" name="remember" class="mr-1 rounded text-[#4A90E2] focus:ring-[#4A90E2]">
                Remember me
            </label>
            <a href="{{ route('password.request') }}"
                class="text-[#4A90E2] hover:text-[#357ABD] text-xs font-bold font-['Poppins'] underline leading-normal transition">
                Forgot Password?
            </a>
        </div>
    </div>
</div>


                <!-- Login Button and Register Link -->
                <div class="w-80 left-[33px] top-[415px] absolute inline-flex flex-col justify-start items-start gap-5 mt-5">
                    <button type="submit" id="loginBtn"
                        class="self-stretch h-9 bg-[#4A90E2] text-white text-base font-medium font-['Poppins'] rounded-lg flex justify-center items-center hover:bg-[#357ABD] transition disabled:opacity-50 disabled:cursor-not-allowed">
                        Log in
                    </button>

                    <div class="self-stretch text-center justify-center">
                        <span class="text-[#000] text-xs font-normal font-['Poppins'] leading-normal tracking-tight">Don’t have an account? </span>
                        <a href="{{ route('register') }}"
                        class="text-[#4A90E2] hover:text-[#357ABD] text-xs font-bold font-['Poppins'] underline leading-normal tracking-tight transition">
                        Register
                        </a>
                    </div>
 
                </div>
            </form>
        </div>

   
</body>
</html>
