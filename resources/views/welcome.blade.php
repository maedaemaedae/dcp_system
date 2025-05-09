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
   <!-- Navigation Bar -->
<nav class="fixed top-0 left-0 right-0 z-50 bg-white shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            
            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('images/landscape-logo.png') }}" alt="YourLogo" class="h-14 w-auto">
                </a>
            </div>

            <!-- Navigation Links -->
            <div class="flex items-center space-x-4">
                @if (Route::has('login'))
                    
                <a href="{{ route('login') }}" class="relative text-[#2D9CDB] text-sm mr-10 group px-2 py-1">
                    Log in
                    <span class="absolute left-0 bottom-0 w-full h-0.5 bg-[#2D9CDB] scale-x-0 group-hover:scale-x-100 transition-transform origin-left duration-300"></span>
                </a>



                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="bg-[#2D9CDB] text-white text-sm px-4 py-2 rounded-full hover:bg-[#238ACB] transition">
                                Register
                            </a>
                        @endif
                
                @endif
            </div>

        </div>
    </div>
</nav>

    <!-- Hero Section -->
    <section class="h-[450px] bg-gradient-to-tr from-white via-gray-50 to-blue-400 py-20 px-6 lg:px-32">
        <!-- Left Content -->
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

            <!-- Right Image with Blob -->
            <div class="relative w-full lg:w-1/2 mb-12 lg:mb-0 flex justify-center">
                <div class="absolute -top-10 -right-10 w-[150%] h-[150%] bg-blue-100 mix-blend-multiply filter blur-3xl opacity-50 -z-10"></div>
                <!-- Carousel Container -->
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
        <script>
                const swiper = new Swiper(".mySwiper", {
                    loop: true,
                    autoplay: {
                        delay: 3000,
                        disableOnInteraction: false,
                    },
                    effect: 'fade',
                    fadeEffect: { crossFade: true },
                });

                
                
            </script>


<script>
    function easeInOutQuad(t) {
        return t < 0.5 ? 2 * t * t : -1 + (4 - 2 * t) * t;
    }

    function smoothScrollTo(targetY, duration = 800) {
        const startY = window.scrollY;
        const diffY = targetY - startY;
        let startTime;

        function animateScroll(currentTime) {
            if (!startTime) startTime = currentTime;
            const timeElapsed = currentTime - startTime;
            const progress = Math.min(timeElapsed / duration, 1);
            const ease = easeInOutQuad(progress);

            window.scrollTo(0, startY + diffY * ease);

            if (timeElapsed < duration) {
                requestAnimationFrame(animateScroll);
            }
        }

        requestAnimationFrame(animateScroll);
    }

    document.querySelector('a[href="#features"]').addEventListener('click', function (e) {
        e.preventDefault();

        const offset = 80; // adjust for fixed navbar
        const target = document.querySelector('#features');
        const top = target.getBoundingClientRect().top + window.scrollY - offset;

        smoothScrollTo(top, 900); // duration in ms
    });
</script>
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
    <section id="forms">
                <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow mb-20">
                <div class="text-center mb-8">
                    <button class="bg-blue-600 text-white px-6 py-3 rounded hover:bg-blue-700">
                        Download Forms & Templates
                    </button>
                </div>

                <!-- Accordion Section -->
                <div class="space-y-4">
                    <!-- Accordion Item 1 -->
                    <div class="border rounded-lg">
                        <button class="w-full text-left px-6 py-4 font-semibold text-blue-800 focus:outline-none flex justify-between items-center accordion-toggle">
                            Documentary Requirements
                            <span class="transform transition-transform duration-200">&#9660;</span>
                        </button>
                        <div class="accordion-content px-6 pb-4 hidden">
                            <ul class="list-disc pl-5 text-gray-700">
                                <li>Letter of Intent</li>
                                <li>School Profile</li>
                                <li>Device Inventory</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Accordion Item 2 -->
                    <div class="border rounded-lg">
                        <button class="w-full text-left px-6 py-4 font-semibold text-blue-800 focus:outline-none flex justify-between items-center accordion-toggle">
                            FAQs (Frequently Asked Questions)
                            <span class="transform transition-transform duration-200">&#9660;</span>
                        </button>
                        <div class="accordion-content px-6 pb-4 hidden">
                            <p class="text-gray-700">Answers to the most common questions regarding submissions, deadlines, and eligibility.</p>
                        </div>
                    </div>

                    <!-- Accordion Item 3 (dynamic and conditional file links) -->
                    <div class="border rounded-lg">
                        <button class="w-full text-left px-6 py-4 font-semibold text-blue-800 focus:outline-none flex justify-between items-center accordion-toggle">
                            DepEd Computerization Program (DCP) FY 2025 EPA References
                            <span class="transform transition-transform duration-200">&#9660;</span>
                        </button>
                        <div class="accordion-content px-6 pb-4 hidden">
                            @if(count($dcpFiles) > 0)
                                <ul class="list-disc pl-5 text-gray-700 space-y-1">
                                    @foreach($dcpFiles as $file)
                                        <li>
                                            @if(Str::endsWith($file, '.pdf'))
                                                <a href="{{ asset('storage/dcp/' . $file) }}" 
                                                target="_blank" 
                                                class="text-blue-600 hover:underline">
                                                    View {{ $file }}
                                                </a>
                                            @else
                                                <a href="{{ asset('storage/dcp/' . $file) }}" 
                                                download 
                                                class="text-blue-600 hover:underline">
                                                    Download {{ $file }}
                                                </a>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-gray-500">No reference files available at the moment.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    document.querySelectorAll('.accordion-toggle').forEach(button => {
                        button.addEventListener('click', () => {
                            const content = button.nextElementSibling;
                            const icon = button.querySelector('span');

                            content.classList.toggle('hidden');
                            icon.classList.toggle('rotate-180');
                        });
                    });
                });
            </script>
    </section>
    <footer class="bg-white border-t mt-20">
    <div class="max-w-7xl mx-auto px-6 py-8 flex flex-col md:flex-row justify-between items-center text-sm text-gray-600">
        <div class="mb-4 md:mb-0">
            © {{ date('Y') }} DCP Tracking System. All rights reserved.
        </div>
        <div class="flex space-x-4">
            <a href="#" class="hover:underline">Privacy Policy</a>
            <a href="#" class="hover:underline">Terms of Service</a>
            <a href="https://mail.google.com/mail/?view=cm&fs=1&to=ict.mimaroparegion@deped.gov.ph" 
                target="_blank" 
                rel="noopener noreferrer"
                class="hover:underline">
                Contact
                </a>
        </div>
    </div>
</footer>
</body>
</html>
