<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DCP Tracking System</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/portrait-logo.png') }}" type="image/png">

    <!-- TailwindCSS & Swiper -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unpkg.com/swiper@11/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper@11/swiper-bundle.min.js"></script>

    <style>
        /* Add custom styles here or keep default Tailwind CSS */
    </style>
</head>

<body class="bg-gray-50 text-gray-800">
    <x-guest-layout>

        <div class="w-[799px] h-[550px] relative bg-white overflow-hidden">

            <!-- Image Side — NOW on the RIGHT -->
            <div class="w-96 h-[550px] left-[399px] top-0 absolute bg-blue-500 rounded-tl-[60px] rounded-bl-[60px] overflow-hidden">
                <img class="w-96 h-[550px] left-0 top-0 absolute opacity-60 backdrop-blur-lg" src="https://placehold.co/400x550" />
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
            <form method="POST" action="{{ route('login') }}" class="flex flex-col">
                @csrf
                <!-- Email Address -->
                <div class="w-80 left-[33px] top-[220px] absolute inline-flex flex-col justify-start items-start">
                    <label class="w-80 text-gray-600 text-xs font-medium font-['Poppins'] leading-normal">Email Address</label>
                    <div class="relative w-full">
                        <input type="email" id="email" name="email" required
                            class="w-80 h-10 px-10 py-1 bg-white rounded-md border border-gray-300 text-gray-600 text-[10px] font-medium font-['Poppins'] leading-normal focus:ring-1 focus:ring-[#2D9CDB] focus:border-[#2D9CDB]"
                            placeholder="Enter your email" />
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
                            class="w-80 h-10 px-10 py-1 pr-10 bg-white rounded-md border border-gray-300 text-gray-600 text-[10px] font-medium font-['Poppins'] leading-normal focus:ring-1 focus:ring-[#2D9CDB] focus:border-[#2D9CDB]" />

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
                                <input type="checkbox" name="remember" class="mr-1 rounded text-[#2D9CDB] focus:ring-[#2D9CDB]">
                                Remember me
                            </label>
                            <a href="{{ route('password.request') }}"
                            class="text-[#2D9CDB] hover:text-[#238ACB] text-xs font-bold font-['Poppins'] underline leading-normal transition">
                            Forgot Password?
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Login Button and Register Link -->
                <div class="w-80 left-[33px] top-[415px] absolute inline-flex flex-col justify-start items-start gap-5 mt-5">
                    <button type="submit"
                        class="self-stretch h-9 bg-[#2D9CDB] text-white text-base font-medium font-['Poppins'] rounded-lg flex justify-center items-center hover:bg-[#238ACB] transition">
                        Log in
                    </button>

                    <div class="self-stretch text-center justify-center">
                        <span class="text-G600 text-xs font-normal font-['Poppins'] leading-normal tracking-tight">Don’t have an account? </span>
                        <a href="{{ route('register') }}"
                        class="text-[#2D9CDB] hover:text-[#238ACB] text-xs font-bold font-['Poppins'] underline leading-normal tracking-tight transition">
                        Register
                        </a>
                    </div>
 
                </div>
            </form>
        </div>

        <!-- Onclick Toggle Password -->
        <script>
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
    </x-guest-layout>
</body>
</html>
