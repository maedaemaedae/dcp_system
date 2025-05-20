<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create an Account</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.bunny.net">

    <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="max-h-screen font-poppins text-gray-900 antialiased bg-gray-100 overflow-y-auto">

    <div class="flex items-center justify-center">
        <div class="w-[799px] h-screen bg-white rounded-xl shadow-lg flex">
            
            <!-- Left Image Section -->
            <div class="w-[386px] h-full overflow-hidden rounded-xl">
                <img src="{{ asset('images/palaro.png') }}" alt="hehe" class="w-full h-full object-cover" />
            </div>

            <!-- Right Form Section -->
            <div class="w-[413px] h-full rounded-lg bg-white px-10 py-6 flex flex-col justify-between overflow-y-auto"> <!-- Adjusted padding and added overflow -->

                <!-- LOGO -->
                <div class="flex justify-center mb-4">
                    <img class="w-16 h-16" src="{{ asset('images/dcp-logo.png') }}" alt="MIMAROPA Logo" />
                </div>

                <div class="text-center text-black text-2xl font-bold font-['Poppins'] mb-6">
                    Create an account
                </div>

                <form method="POST" action="{{ route('register') }}" class="flex flex-col gap-2">
                    @csrf

                    <!-- Username with Icon -->
                    <div>
                        <label class="text-xs font-medium text-gray-600">User  Name</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5.121 17.804A4 4 0 0112 15a4 4 0 016.879 2.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <input type="text"
                                required
                                name="name"
                                class="w-full h-8 pl-9 pr-3 text-xs rounded-md border border-gray-300 focus:ring-1 focus:ring-[#2D9CDB] focus:border-[#2D9CDB]"
                                placeholder="Enter your user name" />
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="relative">
                        <label for="password" class="text-xs font-medium text-gray-600">Password</label>
                        <div class="relative mt-1">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 11c.552 0 1 .448 1 1v1h-2v-1c0-.552.448-1 1-1zm6 0V9a6 6 0 10-12 0v2H4v10h16V11h-2zm-2 0H8V9a4 4 0 118 0v2z" />
                                </svg>
                            </div>
                            <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                            <input
                                id="password"
                                name="password"
                                type="password"
                                required
                                class="w-full h-8 pl-9 pr-9 text-xs rounded-md border border-gray-300 focus:ring-1 focus:ring-[#2D9CDB] focus:border-[#2D9CDB]"
                                placeholder="Create your password"
                            />
                        </div>
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="relative">
                        <label for="password_confirmation" class="text-xs font-medium text-gray-600">Confirm Password</label>
                        <div class="relative mt-1">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 11c.552 0 1 .448 1 1v1h-2v-1c0-.552.448-1 1-1zm6 0V9a6 6 0 10-12 0v2H4v10h16V11h-2zm-2 0H8V9a4 4 0 118 0v2z" />
                                </svg>
                            </div>
                            <button type="button" onclick="toggleConfirmPassword()" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <svg id="eyeIconConfirm" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                            <input
                                type="password"
                                name="password_confirmation"
                                id="password_confirmation"
                                required
                                class="w-full h-8 pl-9 pr-10 text-xs rounded-md border border-gray-300 focus:ring-1 focus:ring-[#2D9CDB] focus:border-[#2D9CDB]"
                                placeholder="Confirm your password"
                            />
                        </div>
                        @error('password_confirmation')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <script>
                        function togglePassword() {
                            const input = document.getElementById('password');
                            const icon = document.getElementById('eyeIcon');
                            const isVisible = input.type === 'text';
                            input.type = isVisible ? 'password' : 'text';
                            icon.innerHTML = isVisible
                                ? `<path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />`
                                : `<path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.973 9.973 0 012.563-4.021m3.011-2.214A9.978 9.978 0 0112 5c4.478 0 8.268 2.943 9.542 7a9.978 9.978 0 01-1.357 2.572M15 12a3 3 0 11-6 0 3 3 0 016 0z" />`;
                        }

                        function toggleConfirmPassword() {
                            const input = document.getElementById('password_confirmation');
                            const icon = document.getElementById('eyeIconConfirm');
                            const isVisible = input.type === 'text';
                            input.type = isVisible ? 'password' : 'text';
                            icon.innerHTML = isVisible
                                ? `<path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />`
                                : `<path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.973 9.973 0 012.563-4.021m3.011-2.214A9.978 9.978 0 0112 5c4.478 0 8.268 2.943 9.542 7a9.978 9.978 0 01-1.357 2.572M15 12a3 3 0 11-6 0 3 3 0 016 0z" />`;
                        }
                    </script>

                    <!-- First Name -->
                    <div>
                        <label class="text-xs font-medium text-gray-600">First Name</label>
                        <input type="text" name="first_name" id="first_name" required class="w-full h-8 px-3 text-xs rounded-md border border-gray-300 focus:ring-1 focus:ring-[#2D9CDB] focus:border-[#2D9CDB]" placeholder="Enter your first name" />
                    </div>

                    <!-- Last Name -->
                    <div>
                        <label class="text-xs font-medium text-gray-600">Last Name</label>
                        <input type="text" name="last_name" id="last_name" required class="w-full h-8 px-3 text-xs rounded-md border border-gray-300 focus:ring-1 focus:ring-[#2D9CDB] focus:border-[#2D9CDB]" placeholder="Enter your last name" />
                    </div>

                    <!-- Gender Selection -->
            <div class="w-[350px]">
                <!-- Label -->
                <label class="block text-gray-600 text-sm font-medium font-[Poppins] mb-2">Gender</label>

                <!-- Radio Group -->
                <div class="flex gap-4">
                    <!-- Male -->
                    <label class="w-[140px] h-10 px-4 py-2 bg-white rounded-md outline outline-1 outline-offset-[-1px] 
                                outline-gray-300 inline-flex items-center gap-2 cursor-pointer transition 
                                peer-checked:outline-blue-400 peer-checked:outline-2">
                        <input type="radio" name="gender" value="male" />
                        <div class="w-3.5 h-3.5 relative">                          
                            <div class="w-2 h-2 bg-transparent rounded-full absolute top-[3px] left-[3px] peer-checked:bg-blue-400 transition"></div>
                        </div>
                        <span class="text-gray-800 text-sm font-[Poppins]">Male</span>
                    </label>

                    <!-- Female -->
                    <label class="w-[140px] h-10 px-4 py-2 bg-white rounded-md outline outline-1 outline-offset-[-1px] 
                                outline-gray-300 inline-flex items-center gap-2 cursor-pointer transition 
                                peer-checked:outline-blue-400 peer-checked:outline-2">
                        <input type="radio" name="gender" value="female" />
                        <div class="w-3.5 h-3.5 relative">
                            <div class="w-2 h-2 bg-transparent rounded-full absolute top-[3px] left-[3px] peer-checked:bg-blue-400 transition"></div>
                        </div>
                        <span class="text-gray-800 text-sm font-[Poppins]">Female</span>
                    </label>
                </div>
            </div>


                    <!-- Email -->
                    <div>
                        <label class="text-xs font-medium text-gray-600">Email Address</label>
                        <input type="email" name="email" id="email" required
                            class="w-full h-8 px-3 text-xs rounded-md border border-gray-300 focus:ring-1 focus:ring-[#2D9CDB] focus:border-[#2D9CDB]"
                            placeholder="Enter your email address" value="{{ old('email') }}" />
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Contact Number -->
                    <div id="contact-container">
                        <label class="text-xs font-medium text-gray-600">Contact Number</label>
                        <input type="text" name="contact_number" id="contact_number" required
                            class="w-full h-8 px-3 text-xs rounded-md border border-gray-300 focus:ring-1 focus:ring-[#2D9CDB] focus:border-[#2D9CDB] peer"
                            placeholder="Enter your contact number" />

                        <!-- Error message (invalid format) -->
                        <p id="invalid-msg" class="mt-1 text-[11px] text-red-500 hidden">
                            Please enter a valid contact number.
                        </p>

                        <!-- Error message (duplicate) -->
                        <p id="duplicate-msg" class="mt-1 text-[11px] text-red-500 hidden">
                            This contact number already exists.
                        </p>
                    </div>

    <script>
    // Example: List of existing numbers
    const existingNumbers = ['09123456789', '09987654321'];

    const input = document.getElementById('contact_number');
    const invalidMsg = document.getElementById('invalid-msg');
    const duplicateMsg = document.getElementById('duplicate-msg');

    input.addEventListener('blur', function () {
        const number = input.value.trim();

        // Basic validation (11 digits, numeric)
        const isValid = /^09\d{9}$/.test(number); // Example: PH number format

        // Reset messages
        invalidMsg.classList.add('hidden');
        duplicateMsg.classList.add('hidden');
        input.classList.remove('border-red-500');

        if (!isValid) {
            invalidMsg.classList.remove('hidden');
            input.classList.add('border-red-500');
        } else if (existingNumbers.includes(number)) {
            duplicateMsg.classList.remove('hidden');
            input.classList.add('border-red-500');
        }
    });
</script>

                    <button type="submit" class="mt-4 w-full h-10 border-2 border-[#2D9CDB] text-[#2D9CDB] text-base font-medium rounded-full hover:bg-[#2D9CDB] hover:text-white transition">
                        Create an account
                    </button>

                    <div class="text-center text-xs mt-2">
                        Already have an account? <a href="{{ route('login') }}" class="text-[#2D9CDB] hover:text-[#238ACB] underline font-bold transition">Login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
