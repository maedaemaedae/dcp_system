<x-guest-layout>

<div class="w-[799px] h-screen bg-white rounded-xl shadow-lg flex">

    <!-- Left Image Section -->
    <div class="w-[386px] h-full overflow-hidden rounded-xl">
        <img src="{{ asset('images/palaro.png') }}" alt="hehe" class="w-full h-full object-cover" />
    </div>

    <!-- Right Form Section -->
    <div class="w-[413px] h-full rounded-lg bg-white px-10 py-10 flex flex-col justify-center">

        <!-- LOGO -->
        <div class="flex justify-center mb-4">
            <img class="w-16 h-16" src="{{ asset('images/dcp-logo.png') }}" alt="MIMAROPA Logo" />
        </div>

        <div class="text-center text-black text-2xl font-bold font-['Poppins'] mb-6">
            Create an account
        </div>
                <!-- Error Display -->
                @if ($errors->any())
                    <div class="mb-4 text-red-600">
                        <ul class="list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
        <form method="POST" action="{{ route('register') }}" class="flex flex-col gap-2">
            @csrf

           <!-- Username with Icon -->
    <div>
        <label class="text-xs font-medium text-gray-600">User Name</label>
        <div class="relative">
            <!-- Icon (Heroicons User Icon) -->
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5.121 17.804A4 4 0 0112 15a4 4 0 016.879 2.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </div>

        <!-- Input -->  
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
        <!-- Lock Icon -->
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none"
         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round"
              d="M12 11c.552 0 1 .448 1 1v1h-2v-1c0-.552.448-1 1-1zm6 0V9a6 6 0 10-12 0v2H4v10h16V11h-2zm-2 0H8V9a4 4 0 118 0v2z" />
    </svg>
</div>

<!-- Add this eye toggle button INSIDE the same relative div -->
<button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 pr-3 flex items-center">
    <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none"
         viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round"
              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
        <path stroke-linecap="round" stroke-linejoin="round"
              d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
    </svg>
</button>


        <!-- Input -->
        <input
            id="password"
            name="password"
            type="password"
            required
            class="w-full h-8 pl-9 text-xs rounded-md border border-gray-300 focus:ring-1 focus:ring-[#2D9CDB] focus:border-[#2D9CDB]"
            placeholder="Create your password"
        />
    </div>
</div>



            <!-- Confirm Password -->
<div class="relative">
    <label for="password_confirmation" class="text-xs font-medium text-gray-600">Confirm Password</label>

    <div class="relative mt-1">
        <!-- Lock Icon -->
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 11c.552 0 1 .448 1 1v1h-2v-1c0-.552.448-1 1-1zm6 0V9a6 6 0 10-12 0v2H4v10h16V11h-2zm-2 0H8V9a4 4 0 118 0v2z" />
            </svg>
        </div>

        <!-- Eye Toggle Button -->
        <button type="button" onclick="toggleConfirmPassword()" class="absolute inset-y-0 right-0 pr-3 flex items-center">
            <svg id="eyeIconConfirm" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            </svg>
        </button>

        <!-- Input Field -->
        <input type="password"
               name="password_confirmation"
               id="password_confirmation"
               required
               class="w-full h-8 pl-9 pr-10 text-xs rounded-md border border-gray-300 focus:ring-1 focus:ring-[#2D9CDB] focus:border-[#2D9CDB]"
               placeholder="Confirm your password" />
    </div>
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

            <!-- Gender -->
            <div>
                <label class="text-xs font-medium text-gray-600">Gender</label>
                <div class="flex gap-4 mt-1">
                    <label class="flex items-center text-xs text-gray-600 gap-1">
                        <input type="radio" name="gender" value="male" required class="w-4 h-4 border-2 border-gray-300 rounded-full checked:bg-[#2D9CDB] checked:border-[#2D9CDB]" />
                        <span>Male</span>
                    </label>
                    <label class="flex items-center text-xs text-gray-600 gap-1">
                        <input type="radio" name="gender" value="female" required class="w-4 h-4 border-2 border-gray-300 rounded-full checked:bg-[#2D9CDB] checked:border-[#2D9CDB]" />
                        <span>Female</span>
                    </label>
                </div>
            </div>

            <!-- Email -->
            <div>
                <label class="text-xs font-medium text-gray-600">Email Address</label>
                <input type="email" name="email" id="email" required class="w-full h-8 px-3 text-xs rounded-md border border-gray-300 focus:ring-1 focus:ring-[#2D9CDB] focus:border-[#2D9CDB]" placeholder="Enter your email address" />
            </div>

            <!-- Contact Number -->
            <div>
                <label class="text-xs font-medium text-gray-600">Contact Number</label>
                <input type="text" name="contact_number" id="contact_number" required class="w-full h-8 px-3 text-xs rounded-md border border-gray-300 focus:ring-1 focus:ring-[#2D9CDB] focus:border-[#2D9CDB]" placeholder="Enter your contact number" />
            </div>

            <button type="submit" class="mt-4 w-full h-10 border-2 border-[#2D9CDB] text-[#2D9CDB] text-base font-medium rounded-full hover:bg-[#2D9CDB] hover:text-white transition">
                Create an account
            </button>

            <div class="text-center text-xs mt-2">
                Already have an account? <a href="{{ route('login') }}" class="text-[#2D9CDB] hover:text-[#238ACB] underline font-bold transition">Login</a>
            </div>
        </form>
    </div>
</div>

</x-guest-layout>
