<!-- Top Navbar -->
<header class="w-full h-20 fixed top-0 left-0 bg-white shadow-md flex items-center justify-between px-8 z-10">
    <div class="flex items-center gap-2">
        <img src="{{ asset('images/landscape-logo.png') }}" class="h-20 w-auto ml-[-20px]" alt="Logo">
    </div>

    <div class="relative" x-data="{ open: false }">
        <!-- User Name -->
        <div class="flex items-center gap-4">
            <span class="text-base text-black">{{ Auth::user()->name }}</span>

            <!-- Profile Dropdown Trigger -->
            <button @click="open = !open" class="w-14 h-14 rounded-full overflow-hidden ring-2 ring-transparent hover:ring-blue-500 transition focus:outline-none mr-[40px]">
                @if (Auth::user()->profile_photo_path)
                    <img id="navbar-profile-photo"
                         src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}"
                         alt="Profile"
                         class="w-full h-full object-cover rounded-full">
                @else
                    <img id="navbar-profile-photo"
                         src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}"
                         alt="Default Avatar"
                         class="w-full h-full object-cover rounded-full">
                @endif
            </button>
        </div>

        <!-- Dropdown Menu -->
        <div x-show="open" @click.away="open = false"
             class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-2 z-20 text-sm text-gray-700"
             x-transition>
            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 hover:bg-blue-100">Profile</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-2 hover:bg-blue-100">Logout</button>
            </form>
        </div>
    </div>
</header>
