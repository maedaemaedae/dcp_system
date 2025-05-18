 <!-- Sidebar -->
 <div x-data="{ open: true }" class="flex">
        <aside
            :class="open ? 'w-[250px]' : 'w-20'"
            class="h-[950px] absolute top-[80px] left-0 bg-[#033372] text-white font-['Poppins'] transition-all duration-300">

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




    @php
        $user = auth()->user();
        $isSuperAdmin = $user && $user->role_id === 1;
        $isAdmin = $user && $user->role && $user->role->role_name === 'admin';
    @endphp


    @if ($isSuperAdmin)
    
       <!-- Sidebar Menu List -->
    <div class="flex flex-col gap-5 px-2.5 mt-20">

<!-- Dashboard -->
<div class="relative group">
    <a href="{{ route('dashboard') }}"
       class="flex items-center gap-5 px-5 py-3 text-[14px] transition-all duration-300  
           hover:bg-white hover:text-[#033372] hover:rounded-xl 
           {{ request()->routeIs('dashboard') ? 'bg-white text-[#033372] rounded-xl' : '' }}">
        
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

<!-- Regional Offices -->
<div class="relative group">
    <a href="{{ route('regional-offices.index') }}"
       class="flex items-center gap-5 px-5 py-3 text-[14px] transition-all duration-300 
           hover:bg-white hover:text-[#033372] hover:rounded-xl
           {{ request()->routeIs('regional-offices.index') ? 'bg-white text-[#033372] rounded-xl' : '' }}">

        <i class="fa-solid fa-building text-xl w-7 h-7"></i>
        <div class="relative overflow-hidden">
            <span class="invisible whitespace-nowrap block">Regional Offices</span>
            <span x-show="open" x-transition class="absolute left-0 top-0 whitespace-nowrap">Regional Offices</span>
        </div>
    </a>
    <div x-show="!open" x-cloak
         class="absolute left-full top-1/2 transform -translate-y-1/2 ml-3 px-2 py-1 bg-black text-white text-xs rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none z-50">
        Regional Offices
    </div>
</div>

<!-- Division Offices -->
<div class="relative group">
    <a href="{{ route('division-offices.index') }}"
       class="flex items-center gap-5 px-5 py-3 text-[14px] transition-all duration-300 
           hover:bg-white hover:text-[#033372] hover:rounded-xl
           {{ request()->routeIs('division-offices.index') ? 'bg-white text-[#033372] rounded-xl' : '' }}">

        <i class="fa-solid fa-sitemap text-xl w-7 h-7"></i>
        <div class="relative overflow-hidden">
            <span class="invisible whitespace-nowrap block">Division Offices</span>
            <span x-show="open" x-transition class="absolute left-0 top-0 whitespace-nowrap">Division Offices</span>
        </div>
    </a>
    <div x-show="!open" x-cloak
         class="absolute left-full top-1/2 transform -translate-y-1/2 ml-2 px-2 py-1 bg-black text-white text-xs rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none z-50">
        Division Offices
    </div>
</div>

<!-- School List -->
<div class="relative group">
    <a href="{{ route('schools.index') }}"
       class="flex items-center gap-5 px-5 py-3 text-[14px] transition-all duration-300 
           hover:bg-white hover:text-[#033372] hover:rounded-xl
           {{ request()->routeIs('schools.index') ? 'bg-white text-[#033372] rounded-xl' : '' }}">

        <i class="fa-solid fa-school text-xl w-7 h-7"></i>
        <div class="relative overflow-hidden">
            <span class="invisible whitespace-nowrap block">School List</span>
            <span x-show="open" x-transition class="absolute left-0 top-0 whitespace-nowrap">School List</span>
        </div>
    </a>
    <div x-show="!open" x-cloak
         class="absolute left-full top-1/2 transform -translate-y-1/2 ml-2 px-2 py-1 bg-black text-white text-xs rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none z-50">
        School List
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

<!-- Packages -->
<div class="relative group">
    <a href="{{ route('package-types.index') }}"
       class="flex items-center gap-5 px-5 py-3 text-[14px] transition-all duration-300 
           hover:bg-white hover:text-[#033372] hover:rounded-xl
           {{ request()->routeIs('package-types.index') ? 'bg-white text-[#033372] rounded-xl' : '' }}">

        <i class="fa-solid fa-box text-xl w-7 h-7"></i>
        <div class="relative overflow-hidden">
            <span class="invisible whitespace-nowrap block">Packages</span>
            <span x-show="open" x-transition class="absolute left-0 top-0 whitespace-nowrap">Packages</span>
        </div>
    </a>
    <div x-show="!open" x-cloak
         class="absolute left-full top-1/2 transform -translate-y-1/2 ml-2 px-2 py-1 bg-black text-white text-xs rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none z-50">
        Packages
    </div>
</div>

<!-- Deliveries -->
<div class="relative group">
    <a href="{{ route('deliveries.index') }}"
       class="flex items-center gap-5 px-5 py-3 text-[14px] transition-all duration-300 
           hover:bg-white hover:text-[#033372] hover:rounded-xl
           {{ request()->routeIs('deliveries.index') ? 'bg-white text-[#033372] rounded-xl' : '' }}">

        <i class="fa-solid fa-box text-xl w-7 h-7"></i>
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

<!-- Projects -->
<div class="relative group">
    <a href="{{ route('projects.index') }}"
       class="flex items-center gap-5 px-5 py-3 text-[14px] transition-all duration-300 
           hover:bg-white hover:text-[#033372] hover:rounded-xl
           {{ request()->routeIs('projects.index') ? 'bg-white text-[#033372] rounded-xl' : '' }}">

        <i class="fa-solid fa-box text-xl w-7 h-7"></i>
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



    @elseif ($isAdmin)
        <!-- User Management -->
        <a href="{{ route('admin.users') }}"
           class="absolute top-[173px] text-[14px] transition-all duration-300"
           :class="open ? 'left-[71px]' : 'left-[60px]'">
            <span x-show="open">User Management</span>
        </a>
        <i class="fa-solid fa-users-gear absolute top-[173px] left-[21px] text-xl w-7 h-7"></i>

        <!-- Regional Offices -->
        <a href="{{ route('admin.regional-offices.index') }}"
           class="absolute top-[266px] text-[14px] transition-all duration-300"
           :class="open ? 'left-[71px]' : 'left-[60px]'">
            <span x-show="open">Regional Offices</span>
        </a>
        <i class="fa-solid fa-building-flag absolute top-[266px] left-[21px] text-xl w-7 h-7"></i>

        <!-- Division Offices -->
        <a href="{{ route('admin.division-offices.index') }}"
           class="absolute top-[354px] text-[14px] transition-all duration-300"
           :class="open ? 'left-[71px]' : 'left-[60px]'">
            <span x-show="open">Division Offices</span>
        </a>
        <i class="fa-solid fa-diagram-project absolute top-[354px] left-[21px] text-xl w-7 h-7"></i>

        <!-- School List -->
        <a href="{{ route('admin.schools.index') }}"
           class="absolute top-[442px] text-[14px] transition-all duration-300"
           :class="open ? 'left-[71px]' : 'left-[60px]'">
            <span x-show="open">School List</span>
        </a>
        <i class="fa-solid fa-school absolute top-[442px] left-[21px] text-xl w-7 h-7"></i>

        <!-- Inventory -->
        <a href="{{ route('admin.inventory.index') }}"
           class="absolute top-[530px] text-[14px] transition-all duration-300"
           :class="open ? 'left-[71px]' : 'left-[60px]'">
            <span x-show="open">Inventory</span>
        </a>
        <i class="fa-solid fa-boxes-stacked absolute top-[530px] left-[21px] text-xl w-7 h-7"></i>

        <!-- Packages -->
        <a href="{{ route('admin.package-types.index') }}"
           class="absolute top-[618px] text-[14px] transition-all duration-300"
           :class="open ? 'left-[71px]' : 'left-[60px]'">
            <span x-show="open">Packages</span>
        </a>
        <i class="fa-solid fa-box-open absolute top-[618px] left-[21px] text-xl w-7 h-7"></i>
    @endif
</aside>