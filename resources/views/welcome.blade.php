<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DCP Tracking Hub</title>
    <link rel="icon" href="{{ asset('images/final-portrait-logo.png') }}" type="image/png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unpkg.com/swiper@11/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper@11/swiper-bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet" />

    <style>
        body { font-family: 'Poppins', sans-serif; }
        .glass {
            background: rgba(255,255,255,0.7);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.18);
            backdrop-filter: blur(8px);
            border-radius: 1.5rem;
        }

         @keyframes gradient {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    .animate-gradient {
        background-size: 200% 200%;
        animation: gradient 15s ease infinite;
    }

    </style>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        new Swiper('.mySwiper', {
            loop: true,
            autoplay: { delay: 3500, disableOnInteraction: false },
            effect: 'fade',
            fadeEffect: { crossFade: true },
        });
        document.querySelectorAll('.accordion-toggle').forEach(button => {
            button.addEventListener('click', () => {
                const content = button.nextElementSibling;
                const icon = button.querySelector('span');
                content.classList.toggle('hidden');
                icon.classList.toggle('rotate-180');
            });
        });
        document.querySelectorAll('a[href="#features"]').forEach(link => {
            link.addEventListener('click', function (e) {
                e.preventDefault();
                const offset = 80;
                const target = document.querySelector('#features');
                const top = target.getBoundingClientRect().top + window.scrollY - offset;
                smoothScrollTo(top, 900);
            });
        });
    });
    
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

    // Prevent zoom with Ctrl + Mouse Wheel and Ctrl + +/- on desktop
            document.addEventListener('wheel', function(e) {
                if (e.ctrlKey) {
                    e.preventDefault();
                }
            }, { passive: false });

            document.addEventListener('keydown', function(e) {
                // Prevent Ctrl + '+', Ctrl + '-', Ctrl + '0'
                if (e.ctrlKey && (e.key === '+' || e.key === '-' || e.key === '=' || e.key === '0')) {
                    e.preventDefault();
                }
            });
</script>
    
</head>
<body class="relative min-h-screen text-gray-800 font-poppins">
    <!-- Decorative Blobs/Gradients -->
    <div class="pointer-events-none select-none absolute -top-32 -left-32 w-[600px] h-[600px] z-0">
       <div class="w-full h-full bg-gradient-to-br from-[#033372]/70 via-[#2D9CDB]/60 to-[#4A90E2]/0 rounded-full blur-3xl opacity-80 animate-pulse"></div>
    </div>
    <div class="pointer-events-none select-none absolute top-1/2 right-0 w-[400px] h-[400px] z-0">
        <div class="w-full h-full bg-gradient-to-tr from-[#2D9CDB]/70 via-[#4A90E2]/40 to-[#033372]/0 rounded-full blur-2xl opacity-70 animate-pulse"></div>
    </div>
    <div class="pointer-events-none select-none absolute bottom-0 left-1/2 -translate-x-1/2 w-[700px] h-[300px] z-0">
        <div class="w-full h-full bg-gradient-to-tl from-[#4A90E2]/40 via-[#2D9CDB]/10 to-[#033372]/0 rounded-full blur-3xl opacity-60"></div>
    </div>
    <!-- Decorative SVG Blob -->
    <svg class="absolute -top-40 -left-40 w-[700px] h-[700px] z-0 opacity-70" viewBox="0 0 700 700" fill="none" xmlns="http://www.w3.org/2000/svg">
      <defs>
        <radialGradient id="blobGradient" cx="50%" cy="50%" r="80%" fx="50%" fy="50%">
          <stop offset="0%" stop-color="#033372" stop-opacity="0.7"/>
          <stop offset="60%" stop-color="#2D9CDB" stop-opacity="0.6"/>
          <stop offset="100%" stop-color="#4A90E2" stop-opacity="0"/>
        </radialGradient>
      </defs>
      <path fill="url(#blobGradient)" d="M540,120Q600,210,570,320Q540,430,430,470Q320,510,210,470Q100,430,70,320Q40,210,120,120Q200,30,320,60Q440,90,540,120Z"/>
    </svg>
    <!-- Navbar -->
    <nav class="fixed top-0 left-0 right-0 z-50 bg-white/80 shadow-md backdrop-blur-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex-shrink-0 flex items-center gap-2">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('images/final-landscape-logo.png') }}" alt="DCP Logo" class="h-12 w-auto">
                    </a>
                   
                </div>
                <div class="flex items-center space-x-8">
                    <a href="{{ route('login') }}" class="text-[#2D9CDB] border border-[#2D9CDB] text-sm px-5 py-2 rounded-full hover:bg-[#2D9CDB] hover:text-white transition shadow">Log in</a>
                    @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="bg-[#2D9CDB] text-white text-sm px-5 py-2 rounded-full hover:bg-[#238ACB] transition shadow">Register</a>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative pt-36 pb-24 px-4 lg:px-0 overflow-hidden z-10">
    <!-- Animated Gradient Background -->
    <div class="absolute inset-0 -z-10 animate-gradient bg-gradient-to-br from-[#45a8ff]/40 via-white to-[#2D9CDB]/70"></div>

    <!-- Animated Blobs -->
    <div class="absolute -top-40 -left-40 w-[700px] h-[700px] z-0 mix-blend-overlay">
        <svg viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
            <g transform="translate(300,300)">
                <path fill="#2D9CDB" opacity="0.6">
                    <animate attributeName="d" dur="10s" repeatCount="indefinite"
                        values="M120,-150C160,-100,190,-50,170,10C150,70,80,140,10,160C-60,180,-120,140,-170,90C-220,40,-260,-20,-220,-80C-180,-140,-90,-180,-10,-190C70,-200,140,-180,120,-150Z;
                                M140,-120C180,-60,210,10,180,70C150,130,70,180,-10,190C-90,200,-180,160,-200,90C-220,20,-160,-50,-110,-110C-60,-170,0,-220,60,-200C120,-180,100,-180,140,-120Z;
                                M120,-150C160,-100,190,-50,170,10C150,70,80,140,10,160C-60,180,-120,140,-170,90C-220,40,-260,-20,-220,-80C-180,-140,-90,-180,-10,-190C70,-200,140,-180,120,-150Z" />
                </path>
            </g>
        </svg>
    </div>

    <!-- Hero Content -->
    <div class="max-w-7xl mx-auto flex flex-col-reverse lg:flex-row items-center justify-between gap-14 relative z-10">
        <div class="w-full lg:w-1/2 text-center lg:text-left">
            <h1 class="text-4xl md:text-6xl font-extrabold text-gray-900 leading-tight mb-6">
                Take Charge of Your Inventory.<br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#033372] via-[#2D9CDB] to-[#4A90E2]">One Smart Dashboard.</span>
            </h1>
            <p class="mt-4 text-gray-700 text-lg max-w-xl mx-auto lg:mx-0">
                Track smarter. Manage better. Your inventory, fully under control—accessible anytime, anywhere.
            </p>
            <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                <a href="#forms" class="bg-[#2D9CDB] hover:bg-[#238ACB] text-white px-8 py-3 rounded-full text-lg font-semibold shadow-lg transition-all duration-300">
                    Download Resources
                </a>
            </div>
        </div>

        <div class="w-full lg:w-1/2 flex justify-center items-center">
            <img 
                src="{{ asset('images/dashboard mockups 1.png') }}" 
                alt="Dashboard Preview" 
                class="object-cover rounded-2xl shadow-2xl ring-1 ring-white/30"
                style="width: 1514px; height: 783;"
            >
        </div>
    </div>
</section>


    <!-- Forms & Resources Section -->
    <section id="forms" class="py-24 px-4 lg:px-0">
        <div class="max-w-4xl mx-auto glass p-10 rounded-2xl shadow-xl">
            <div class="text-center mb-8">
                <h3 class="text-2xl font-bold text-gray-800 mb-2">Resources & Downloads</h3>
                <p class="text-gray-600 mb-6">Access important forms, templates, and references for your DCP needs.</p>
                <a class="bg-[#2D9CDB] text-white px-8 py-3 rounded-full text-lg font-semibold hover:bg-[#238ACB] transition shadow" href="#">Download All</a>
            </div>
            <div class="space-y-4">
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
                <div class="border rounded-lg">
                    <button class="w-full text-left px-6 py-4 font-semibold text-blue-800 focus:outline-none flex justify-between items-center accordion-toggle">
                        FAQs (Frequently Asked Questions)
                        <span class="transform transition-transform duration-200">&#9660;</span>
                    </button>
                    <div class="accordion-content px-6 pb-4 hidden">
                        <p class="text-gray-700">Answers to the most common questions regarding submissions, deadlines, and eligibility.</p>
                    </div>
                </div>
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
                                            <a href="{{ asset('storage/dcp/' . $file) }}" target="_blank" class="text-blue-600 hover:underline">View {{ $file }}</a>
                                        @else
                                            <a href="{{ asset('storage/dcp/' . $file) }}" download class="text-blue-600 hover:underline">Download {{ $file }}</a>
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
    </section>
    @include('layouts.footer')
</body>
</html>
