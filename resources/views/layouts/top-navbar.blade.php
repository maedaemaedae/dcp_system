<!-- Top Navbar -->
<header class="w-full h-20 fixed top-0 left-0 bg-white shadow-md flex items-center justify-between px-8 z-10">
    <div class="flex items-center gap-2">
        <img src="{{ asset('images/final-landscape-logo.png') }}" class="h-20 w-auto ml-[-20px]" alt="Logo">
    </div>

    <div class="relative" x-data="{ open: false, openBell: false }">
        <!-- User Name and Notification Bell -->
        <div class="flex items-center gap-4">
            <span class="text-base text-black">{{ Auth::user()->name }}</span>
            <span class="text-sm text-gray-500">{{ Auth::user()->email }}</span>

           @php
                $notifications = Auth::user()->unreadNotifications;
            @endphp

        <div class="relative">
            <button 
                @click="openBell = !openBell; markNotificationsAsRead();" 
                class="w-12 h-12 flex items-center justify-center rounded-full hover:bg-blue-50 transition focus:outline-none" 
                aria-label="Notifications"
                x-ref="bellBtn"
            >

                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
                @if ($notifications->count())
                    <span class="absolute top-0 right-0 block h-3 w-3 rounded-full bg-red-500 ring-2 ring-white"></span>
                @endif
            </button>

            <div x-show="openBell" @click.away="openBell = false" class="absolute right-0 mt-2 w-72 bg-white rounded-md shadow-lg py-2 z-20 text-sm text-gray-700 max-h-96 overflow-y-auto" x-transition>
               @forelse ($notifications as $notification)
                <a href="{{ $notification->data['url'] ?? '#' }}"
                class="block px-4 py-2 hover:bg-blue-50 border-b border-gray-100">
                    <div class="flex flex-col">
                        <strong class="text-sm text-gray-800">{{ $notification->data['title'] }}</strong>
                        <span class="text-gray-600 text-xs">{{ $notification->data['message'] }}</span>
                        <span class="text-gray-400 text-xs mt-1">{{ $notification->created_at->diffForHumans() }}</span>
                    </div>
                </a>
            @empty
                <div class="px-4 py-3 text-center text-gray-500">
                    <span>No new notifications</span>
                </div>
            @endforelse

            </div>
        </div>

             
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
<script>
    function markNotificationsAsRead() {
        fetch("{{ route('notifications.markRead') }}", {
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        }).then(response => {
            if (response.ok) {
                // Optional: reload part of UI or remove red dot manually
                document.querySelectorAll('[x-ref="bellBtn"] span').forEach(el => el.remove());
            }
        });
    }
</script>
