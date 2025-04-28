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
    <!-- Navbar -->
    <nav class="fixed top-0 left-0 right-0 z-50 bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex-shrink-0">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('images/landscape-logo.png') }}" alt="YourLogo" class="h-14 w-auto">
                    </a>
                </div>
                <div class="flex items-center space-x-12">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="h-[450px] bg-gradient-to-tr from-white via-gray-50 to-blue-400 py-20 px-6 lg:px-32">
        <div class="max-w-7xl mx-auto flex flex-col-reverse lg:flex-row items-center justify-between relative ">
            <div class="text-center lg:text-left max-w-xl z-10 ml-10 mt-[-50px]">
                <h1 class="text-4xl md:text-5xl font-bold text-gray-800 leading-tight">
                    Track Anything <br>
                    <h2 class="text-sky-500 mt-5 text-4xl md:text-5xl font-bold">Anytime, Anywhere</h2>
                </h1>
                <p class="mt-6 text-gray-600 text-md">
                    From shipment to delivery, stay in control every step of the way.
                </p>
                <a href="#features" class="inline-block mt-6 bg-blue-600 text-white hover:bg-blue-700 px-6 py-3 rounded-full text-md font-semibold transition shadow-md">
                    Explore Features
                </a>
            </div>

            <div class="relative w-full lg:w-1/2 mb-12 lg:mb-0 flex justify-center">
                <div class="absolute -top-10 -right-10 w-[150%] h-[150%] bg-blue-100 mix-blend-multiply filter blur-3xl opacity-50 -z-10"></div>
                <div class="w-[596px] h-[445px] mt-6">
                    <div class="swiper mySwiper h-full overflow-hidden">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img src="{{ asset('images/slider1.png') }}" class="w-full h-full object-cover" alt="slide 1">
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('images/slider2.png') }}" class="w-full h-full object-cover" alt="slide 2">
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('images/slider3.png') }}" class="w-full h-full object-cover" alt="slide 3">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="bg-white py-20 px-6 lg:px-32 my-32">
        <div class="max-w-7xl mx-auto text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Why Choose DCP Tracking Hub?</h2>
            <p class="text-gray-600 text-md max-w-2xl mx-auto">
                Experience real-time tracking, seamless updates, and reliable support all in one platform.
            </p>
        </div>

        <div class="grid gap-10 md:grid-cols-2 lg:grid-cols-3">
            <div class="bg-gray-50 p-6 rounded-xl shadow hover:shadow-lg transition duration-300 ease-in-out">
                <div class="text-4xl mb-4">📦</div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Real-Time Updates</h3>
                <p class="text-gray-600 text-sm">
                    Monitor your shipments in real-time with live syncing across all your devices.
                </p>
            </div>

            <div class="bg-gray-50 p-6 rounded-xl shadow hover:shadow-lg transition duration-300 ease-in-out">
                <div class="text-4xl mb-4">🛡️</div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Secure & Reliable</h3>
                <p class="text-gray-600 text-sm">
                    Built with enterprise-grade security to keep your data safe and deliveries consistent.
                </p>
            </div>

            <div class="bg-gray-50 p-6 rounded-xl shadow hover:shadow-lg transition duration-300 ease-in-out">
                <div class="text-4xl mb-4">📱</div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Mobile Friendly</h3>
                <p class="text-gray-600 text-sm">
                    Stay updated on the go—track shipments anytime, anywhere via mobile or tablet.
                </p>
            </div>
        </div>
    </section>

</body>
</html>
