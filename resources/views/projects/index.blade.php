<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Projects and Package Types</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>


    <script>
        function toggleAddDropdown() {
            const dropdown = document.getElementById('addDropdown');
            dropdown.classList.toggle('hidden');
        }

        function closeAddDropdown() {
            const dropdown = document.getElementById('addDropdown');
            dropdown.classList.add('hidden');
        }

        function openModal(id) {
            document.getElementById(id)?.classList.remove('hidden');
        }

        function closeModal(id) {
            document.getElementById(id)?.classList.add('hidden');
        }

        function openDeleteModal(type, id) {
            const form = document.getElementById('deleteForm');
            form.action = `/projects/${type}/${id}`;
            openModal('deleteModal');
        }
    
    function openModal(id) {
        const modal = document.getElementById(id);
        modal.classList.remove('hidden');
        setTimeout(() => {
            modal.classList.add('flex');
            modal.classList.remove('opacity-0');
            modal.classList.add('opacity-100');
        }, 10); // short delay ensures CSS transition works
    }

    function closeModal(id) {
        const modal = document.getElementById(id);
        modal.classList.remove('opacity-100');
        modal.classList.add('opacity-0');
        setTimeout(() => {
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }, 300); // Match the duration in your Tailwind transition
    }

    function handleAjaxPagination(containerId, type, pageParam) {
    document.getElementById(containerId)?.addEventListener('click', function (e) {
        const target = e.target.closest('a');
        if (target && target.href.includes(`${pageParam}=`)) {
            e.preventDefault();
            const url = new URL(target.href);
            url.searchParams.set('type', type); // Ensure ?type=projects is added

            fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(response => response.text())
            .then(html => {
                document.getElementById(containerId).innerHTML = html;
                window.history.pushState(null, '', url);
            })
            .catch(err => console.error('Pagination failed:', err));
        }
    });
}

document.addEventListener('DOMContentLoaded', function () {
    handleAjaxPagination('projectsSection', 'projects', 'projects_page');
    handleAjaxPagination('packagesSection', 'packages', 'packages_page');
    handleAjaxPagination('packageTypesSection', 'package_types', 'package_types_page');
});

</script>


<style>
    @keyframes fadeInUp {
    0% {
        opacity: 0;
        transform: translateY(20px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fadeInUp {
    animation: fadeInUp 0.4s ease-out both;
}

</style>


   
</head>

<header class="p-6 bg-white shadow">
        <h2 class="text-xl font-semibold">Projects and Package Types</h2>
    </header>

<body class="bg-white font-['Poppins']" x-data="{ open: true }">
    <div class="flex ">

        
            @include('layouts.sidebar') 
       

        <div class="fixed top-0 left-[300px] right-0 bg-white shadow-md h-20 z-10 transition-all duration-300" :class="open ? 'left-[300px]' : 'left-20'">
            @include('layouts.top-navbar') 
            <div class="flex items-center justify-between h-full px-8">
                
        </div>

    

  <main  :class="open ? 'ml-[5px]' : 'ml-5'" class="transition-all duration-300 p-8 pb-20 relative flex-1 overflow-y-auto h-screen">

    <div class="max-w-6xl mx-auto">
        <h2 class="text-[42px] font-bold text-gray-800 dark:text-white mb-6 border-b border-gray-300 dark:border-gray-600 pb-2 tracking-wide flex items-center gap-4">
             <i class="fa-solid fa-clipboard-list text-blue-500 text-4xl w-10 h-10 pl-1"></i>
            Project and Package Types
        </h2>


    <!-- + Add Dropdown Button -->
<section class="relative mb-6">
    <button onclick="toggleAddDropdown()" class="bg-[#4A90E2] hover:bg-[#357ABD] text-white font-medium px-6 py-2.5 rounded-full shadow-md hover:shadow-lg transition-all duration-300 ease-in-out mb-4 flex items-center space-x-2">
                   <i class="fas fa-plus"></i>
                <span>Add</span>
    </button>
    <div id="addDropdown" class="absolute z-10 mt-2 bg-white shadow-lg rounded w-48 border text-sm hidden">
        <button onclick="openModal('createProjectModal'); closeAddDropdown();" class="flex items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-blue-600 transition-colors duration-150">
        <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
        </svg>
        Add Project
        </button>
        <button onclick="openModal('createPackageTypeModal'); closeAddDropdown();" class="flex items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-blue-600 transition-colors duration-150">
        <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
        </svg>
        Add Package Type
    </div>
</section>

<!-- 📦 Package Types Section -->
<section id="packageTypesSection" class="bg-white rounded-lg shadow p-6 mb-8">
     @include('projects.partials.package-types-card', ['packageTypes' => $packageTypes])
     
</section>

<!-- 📦 Packages Section -->
<section id="packagesSection" class="bg-white rounded-lg shadow p-6 mb-8">
     @include('projects.partials.packages-card', ['packages' => $packages])
</section>

<!-- 📁 Projects Table Section -->
<section id="projectsSection" class="bg-white rounded-lg shadow p-6 mb-20">
     @include('projects.partials.projects-table', ['projects' => $projects])
</section>

</main>

 {{-- ✅ Modal Includes --}}
    @include('projects.partials.create-project-modal')
    @include('projects.partials.create-package-type-modal')
    @include('projects.partials.edit-project-modal')
    @include('projects.partials.edit-package-modal')
   
    <!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-6 relative animate-fadeInUp font-['Poppins']">
        <!-- Close Button -->
        <button onclick="closeModal('deleteModal')"
                class="absolute top-3 right-3 text-gray-500 hover:text-gray-700 text-2xl leading-none">
            &times;
        </button>

        <!-- Header -->
        <h2 class="text-xl font-bold text-gray-800 mb-3 text-center">🗑️ Confirm Deletion</h2>
        <p class="text-sm text-gray-600 mb-6 text-center">Are you sure you want to delete this record? This action cannot be undone.</p>

        <!-- Deletion Form -->
        <form id="deleteForm" method="POST" class="flex justify-center gap-4">
            @csrf
            @method('DELETE')
            <button type="button" onclick="closeModal('deleteModal')" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-md transition">
                Cancel
            </button>
            <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-md transition">
                Delete
            </button>
        </form>
    </div>
</div>




    

</body>
</html>
