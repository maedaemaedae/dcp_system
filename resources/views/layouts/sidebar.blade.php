 
 <!-- Sidebar -->
 <div x-data="{ open: true }" >
        <aside
            :class="open ? 'w-[250px]' : 'w-20'"
            class="h-[702px] absolute top-[80px] left-0 bg-[#033372] text-white font-['Poppins'] transition-all duration-300 overflow-y-auto [scrollbar-width:none] [-ms-overflow-style:none] custom-scrollbar-hide">

    <!-- Sidebar Toggle Button (aligned vertically with menu items) -->
<button @click="open = !open"
        class="absolute top-4 right-4 px-5 py-3 gap-5 text-white hover:bg-white hover:text-[#033372]
               rounded-xl transition-all duration-300 z-20 mr-[-5px]
               flex items-center justify-center w-13 h-13">
    <template x-if="!open">
        <i class="fas fa-bars text-[20px] item-center transition duration-300 ease-in-out"></i>
    </template>
    <template x-if="open">
        <i class="fas fa-arrow-left text-[20px] transition duration-300 ease-in-out"></i>
    </template>
</button>

   
    <!--Super Admin Sidebar Links -->
       <!-- Sidebar Menu List -->
    <div class="flex flex-col gap-5 px-2.5 mt-20">
                
<!-- Dashboard -->
<div class="relative group">
          @php
                    $user = auth()->user();
                    $dashboardRoute = ($user && $user->role_id === 1)
                        ? 'superadmin.dashboard'
                        : 'dashboard';
                @endphp     

    <a href="{{ route($dashboardRoute) }}"
       class="flex items-center gap-5 px-5 py-3 text-[14px] transition-all duration-300  
           hover:bg-white hover:text-[#033372] hover:rounded-xl 
           {{ request()->routeIs($dashboardRoute) ? 'bg-white text-[#033372] rounded-xl' : '' }}">
        
        <i class="fa-solid fa-gauge-high text-xl w-7 h-7 transition duration-300 ease-in-out"></i>

        <div class="relative overflow-hidden">
            <span class="invisible whitespace-nowrap block">Dashboard</span>
            <span x-show="open" x-transition class="absolute left-0 top-0 whitespace-nowrap">Dashboard</span>
        </div>
    </a>

    <!-- Tooltip -->
    <div x-show="!open" x-cloak
         class="absolute left-full top-1/2 transform -translate-y-1/2 ml-2 px-2 py-1 bg-black text-white text-xs rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none z-50">
        Dashboard
    </div>
</div>

 @if ($user && $user->role_id === 1)
<!-- User Management -->
<div class="relative group">
    <a href="{{ route('superadmin.users') }}"
       class="flex items-center gap-5 px-5 py-3 text-[14px] transition-all duration-300 
           hover:bg-white hover:text-[#033372] hover:rounded-xl
           {{ request()->routeIs('superadmin.users') ? 'bg-white text-[#033372] rounded-xl' : '' }}">

        <i class="fa-solid fa-users text-xl w-7 h-7"></i>

        <div class="relative overflow-hidden">
            <span class="invisible whitespace-nowrap block">Manage Users</span>
            <span x-show="open" x-transition class="absolute left-0 top-0 whitespace-nowrap">Manage Users</span>
        </div>
    </a>

    <!-- Tooltip -->
    <div x-show="!open" x-cloak
         class="absolute left-full top-1/2 transform -translate-y-1/2 ml-2 px-2 py-1 bg-black text-white text-xs rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none z-50">
        User Management
    </div>
</div>


<!-- Recipients -->
<div class="relative group">
    <a href="{{ route('recipients.index') }}"
       class="flex items-center gap-5 px-5 py-3 text-[14px] transition-all duration-300 
           hover:bg-white hover:text-[#033372] hover:rounded-xl
           {{ request()->routeIs('recipients.index') ? 'bg-white text-[#033372] rounded-xl' : '' }}">

        <i class="fa-solid fa-sitemap text-xl w-7 h-7"></i>
        <div class="relative overflow-hidden">
            <span class="invisible whitespace-nowrap block">Recipients</span>
            <span x-show="open" x-transition class="absolute left-0 top-0 whitespace-nowrap">Recipients</span>
        </div>
    </a>
    <div x-show="!open" x-cloak
         class="absolute left-full top-1/2 transform -translate-y-1/2 ml-2 px-2 py-1 bg-black text-white text-xs rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none z-50">
        Recipients
    </div>
</div>

<!-- Projects -->
<div class="relative group">
    <a href="{{ route('projects.index') }}"
       class="flex items-center gap-5 px-5 py-3 text-[14px] transition-all duration-300 
           hover:bg-white hover:text-[#033372] hover:rounded-xl
           {{ request()->routeIs('projects.index') ? 'bg-white text-[#033372] rounded-xl' : '' }}">

      <i class="fa-solid fa-clipboard-list text-xl w-7 h-7"></i>
        <div class="relative overflow-hidden">
            <span class="invisible whitespace-nowrap block">Projects</span>
            <span x-show="open" x-transition class="absolute left-0 top-0 whitespace-nowrap">Projects</span>
        </div>
    </a>
    <div x-show="!open" x-cloak
         class="absolute left-full top-1/2 transform -translate-y-1/2 ml-2 px-2 py-1 bg-black text-white text-xs rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none z-50">
        Projects
    </div>
</div>



<!-- Inventory -->
<div class="relative group">
    <a href="{{ route('inventory.index') }}"
       class="flex items-center gap-5 px-5 py-3 text-[14px] transition-all duration-300 
           hover:bg-white hover:text-[#033372] hover:rounded-xl
           {{ request()->routeIs('inventory.index') ? 'bg-white text-[#033372] rounded-xl' : '' }}">

        <i class="fa-solid fa-boxes-stacked text-xl w-7 h-7"></i>
        <div class="relative overflow-hidden">
            <span class="invisible whitespace-nowrap block">Inventory</span>
            <span x-show="open" x-transition class="absolute left-0 top-0 whitespace-nowrap">Inventory</span>
        </div>
    </a>
    <div x-show="!open" x-cloak
         class="absolute left-full top-1/2 transform -translate-y-1/2 ml-2 px-2 py-1 bg-black text-white text-xs rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none z-50">
        Inventory
    </div>
</div>

<!-- Deliveries -->
<div class="relative group">
    <a href="{{ route('superadmin.deliveries.index') }}"
       class="flex items-center gap-5 px-5 py-3 text-[14px] transition-all duration-300 
           hover:bg-white hover:text-[#033372] hover:rounded-xl
           {{ request()->routeIs('superadmin.deliveries.index') ? 'bg-white text-[#033372] rounded-xl' : '' }}">

       <i class="fa-solid fa-truck text-xl w-7 h-7"></i>

        <div class="relative overflow-hidden">
            <span class="invisible whitespace-nowrap block">Deliveries</span>
            <span x-show="open" x-transition class="absolute left-0 top-0 whitespace-nowrap">Deliveries</span>
        </div>
    </a>
    <div x-show="!open" x-cloak
         class="absolute left-full top-1/2 transform -translate-y-1/2 ml-2 px-2 py-1 bg-black text-white text-xs rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none z-50">
        Deliveries
    </div>
</div>
@endif


    @if ($user && $user->role_id === 6)
        <!-- Deliveries -->
<div class="relative group">
    <a href="{{ route('supplier.deliveries') }}"
       class="flex items-center gap-5 px-5 py-3 text-[14px] transition-all duration-300 
           hover:bg-white hover:text-[#033372] hover:rounded-xl
           {{ request()->routeIs('supplier.deliveries') ? 'bg-white text-[#033372] rounded-xl' : '' }}">

       <i class="fa-solid fa-truck text-xl w-7 h-7"></i>

        <div class="relative overflow-hidden">
            <span class="invisible whitespace-nowrap block">My Deliveries</span>
            <span x-show="open" x-transition class="absolute left-0 top-0 whitespace-nowrap">My Deliveries</span>
        </div>
    </a>
    <div x-show="!open" x-cloak
         class="absolute left-full top-1/2 transform -translate-y-1/2 ml-2 px-2 py-1 bg-black text-white text-xs rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none z-50">
        My Deliveries
    </div>
</div>

    @endif
</aside>