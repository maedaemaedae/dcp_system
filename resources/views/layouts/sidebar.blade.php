 
 <!-- Sidebar -->
 <div x-data="{ open: true }" x-cloak>
        <aside  
    :class="open ? 'w-[250px]' : 'w-20'"
    class="fixed top-[80px] left-0 bottom-0 bg-[#033372] text-white font-['Poppins']
           transition-all duration-300 z-50 overflow-hidden hide-scrollbar">


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
                    $dashboardRoute = ($user && $user->role_id === 1)
                        ? 'superadmin.dashboard'
                        : 'dashboard';
                @endphp  


    <!--Super Admin Sidebar Links -->
       <!-- Sidebar Menu List -->
    <div class="flex flex-col gap-5 px-2.5 mt-20">

        
@if ($user && $user->role_id === 1)
<!-- Dashboard -->
<div class="relative group">
         

    <a href="{{ route($dashboardRoute) }}"
       class="flex items-center gap-5 px-5 py-3 text-[14px] transition-all duration-300  
           hover:bg-white hover:text-[#033372] hover:rounded-xl 
           {{ request()->routeIs($dashboardRoute) ? 'bg-white text-[#033372] rounded-xl' : '' }}"
            title="Dashboard">
        
        <i class="fa-solid fa-gauge-high text-xl w-7 h-7 transition duration-300 ease-in-out"></i>

        <div class="relative overflow-hidden">
            <span class="invisible whitespace-nowrap block">Dashboard</span>
            <span x-show="open"  x-transition class="absolute left-0 top-0 whitespace-nowrap">Dashboard</span>
        </div>
    </a>
</div>

 
<!-- User Management -->
<div class="relative group">
    <a href="{{ route('superadmin.users') }}"
       class="flex items-center gap-5 px-5 py-3 text-[14px] transition-all duration-300 
           hover:bg-white hover:text-[#033372] hover:rounded-xl
           {{ request()->routeIs('superadmin.users') ? 'bg-white text-[#033372] rounded-xl' : '' }}"
            title="Manage Users">

        <i class="fa-solid fa-users text-xl w-7 h-7"></i>

        <div class="relative overflow-hidden">
            <span class="invisible whitespace-nowrap block">Manage Users</span>
            <span x-show="open" x-transition class="absolute left-0 top-0 whitespace-nowrap">Manage Users</span>
        </div>
    </a>
</div>


<!-- Recipients -->
<div class="relative group">
    <a href="{{ route('recipients.index') }}"
       class="flex items-center gap-5 px-5 py-3 text-[14px] transition-all duration-300 
           hover:bg-white hover:text-[#033372] hover:rounded-xl
           {{ request()->routeIs('recipients.index') ? 'bg-white text-[#033372] rounded-xl' : '' }}"
            title="Recipients">

       <i class="fa-solid fa-id-badge text-xl w-7 h-7 pl-1"></i>

        <div class="relative overflow-hidden">
            <span class="invisible whitespace-nowrap block">Recipients</span>
            <span x-show="open" x-transition class="absolute left-0 top-0 whitespace-nowrap">Recipients</span>
        </div>
    </a>
</div>

<!-- Projects -->
<div class="relative group">
    <a href="{{ route('projects.index') }}"
       class="flex items-center gap-5 px-5 py-3 text-[14px] transition-all duration-300 
           hover:bg-white hover:text-[#033372] hover:rounded-xl
           {{ request()->routeIs('projects.index') ? 'bg-white text-[#033372] rounded-xl' : '' }}"
            title="Projects">

      <i class="fa-solid fa-clipboard-list text-xl w-7 h-7 pl-1"></i>
        <div class="relative overflow-hidden">
            <span class="invisible whitespace-nowrap block">Projects</span>
            <span x-show="open" x-transition class="absolute left-0 top-0 whitespace-nowrap">Projects</span>
        </div>
    </a>
</div>



<!-- Inventory -->
<div class="relative group">
    <a href="{{ route('inventory.index') }}"
       class="flex items-center gap-5 px-5 py-3 text-[14px] transition-all duration-300 
           hover:bg-white hover:text-[#033372] hover:rounded-xl
           {{ request()->routeIs('inventory.index') ? 'bg-white text-[#033372] rounded-xl' : '' }}"
            title="Inventory">

        <i class="fa-solid fa-boxes-stacked text-xl w-7 h-7"></i>
        <div class="relative overflow-hidden">
            <span class="invisible whitespace-nowrap block">Inventory</span>
            <span x-show="open" x-transition class="absolute left-0 top-0 whitespace-nowrap">Inventory</span>
        </div>
    </a>
</div>

<!-- Deliveries (with child links) -->
<div class="relative group" 
     x-data="{ deliveriesOpen: {{ request()->routeIs('superadmin.deliveries.*') ? 'true' : 'false' }} }" 
     x-init="$watch('open', val => { if (!val) deliveriesOpen = false })">

    <!-- Main Menu Button -->
    <button @click="if(open) deliveriesOpen = !deliveriesOpen"
        class="flex items-center gap-5 px-5 py-3 text-[14px] w-full transition-all duration-200 
               hover:bg-white hover:text-[#033372] hover:rounded-xl
               {{ request()->routeIs('superadmin.deliveries.*') ? 'bg-white text-[#033372] rounded-xl' : '' }}"
                title="Deliveries">

        <i class="fa-solid fa-truck text-xl w-7 h-7"></i>
        <div class="relative overflow-hidden flex-1 text-left">
            <span class="invisible whitespace-nowrap block">Deliveries</span>
            <span x-show="open" x-transition class="absolute left-0 top-0 whitespace-nowrap">Deliveries</span>
        </div>
        <i class="fa-solid" 
           :class="deliveriesOpen ? 'fa-chevron-up' : 'fa-chevron-down'" 
           x-show="open"></i>
    </button>


    <!-- Child links with smooth collapse animation -->
    <div 
        x-show="deliveriesOpen && open"
        x-collapse
        x-cloak
        style="transition: height 0.3s ease;"
        class="pl-10 mt-2 space-y-1 border-l border-white/20 ml-2"
    >
        <a href="{{ route('superadmin.deliveries.index') }}"
           class="flex items-center gap-2 text-sm py-2.5 px-3.5 rounded-lg transition-all duration-200 mb-2
                  {{ request()->routeIs('superadmin.deliveries.index') 
                      ? 'bg-white text-[#033372] font-medium border-l-4 border-[#033372]' 
                      : 'text-white hover:bg-white/10 hover:pl-4' }}"
                      title="Assign Deliveries">

            <i class="fa-solid fa-list-check text-[13px]"></i>
            Assign to Supplier
        </a>

        <a href="{{ route('superadmin.deliveries.list') }}"
           class="flex items-center gap-2 text-sm py-2 px-2 rounded-lg transition-all duration-200
                  {{ request()->routeIs('superadmin.deliveries.list') 
                      ? 'bg-white text-[#033372] font-medium border-l-4 border-[#033372]' 
                      : 'text-white hover:bg-white/10 hover:pl-3' }}"
                      title="Assigned Deliveries">
                      
            <i class="fa-solid fa-truck text-xs"></i>
            Assigned Deliveries
        </a>
    </div>
</div>
</div>



@endif

{{-- ✅ Supplier Links --}}
@if ($user && $user->role_id === 6)
    <div class="relative group">
        <a href="{{ route('supplier.deliveries.index') }}"
           class="flex items-center gap-5 px-5 py-3 text-[14px] transition-all duration-300 
               hover:bg-white hover:text-[#033372] hover:rounded-xl
               {{ request()->routeIs('supplier.deliveries') ? 'bg-white text-[#033372] rounded-xl' : '' }}">

           <i class="fa-solid fa-truck-ramp-box text-xl w-7 h-7"></i>

            <div class="relative overflow-hidden">
                <span class="invisible whitespace-nowrap block">My Deliveries</span>
                <span x-show="open" x-transition class="absolute left-0 top-0 whitespace-nowrap">My Deliveries</span>
            </div>
        </a>

        <!-- Tooltip -->
        <div x-show="!open" x-cloak
             class="absolute left-full top-1/2 transform -translate-y-1/2 ml-2 px-2 py-1 bg-black text-white text-xs rounded opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none z-50">
            My Deliveries
        </div>
    </div>
@endif

</aside>