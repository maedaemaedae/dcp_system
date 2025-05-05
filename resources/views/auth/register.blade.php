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

            <!-- Username -->
            <div>
                <label class="text-xs font-medium text-gray-600">User Name</label>
                <input type="text" name="name" id="username" required class="w-full h-8 px-3 text-xs rounded-md border border-gray-300 focus:ring-1 focus:ring-[#2D9CDB] focus:border-[#2D9CDB]" placeholder="Enter your user name" />
            </div>

            <!-- Password -->
            <div>
                <label class="text-xs font-medium text-gray-600">Password</label>
                <input type="password" name="password" id="password" required class="w-full h-8 px-3 text-xs rounded-md border border-gray-300 focus:ring-1 focus:ring-[#2D9CDB] focus:border-[#2D9CDB]" placeholder="Create your password" />
            </div>

            <!-- Confirm Password -->
            <div>
                <label class="text-xs font-medium text-gray-600">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required class="w-full h-8 px-3 text-xs rounded-md border border-gray-300 focus:ring-1 focus:ring-[#2D9CDB] focus:border-[#2D9CDB]" placeholder="Confirm your password" />
            </div>

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
