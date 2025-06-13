<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Projects and Package Types</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

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
    </script>
   
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
    <button onclick="toggleAddDropdown()" class="bg-[#4A90E2] hover:bg-[#3B78C2] text-white px-4 py-2 rounded shadow text-sm">
        + Add
    </button>
    <div id="addDropdown" class="absolute z-10 mt-2 bg-white shadow-lg rounded w-48 border text-sm hidden">
        <button onclick="openModal('createProjectModal'); closeAddDropdown();" class="block w-full px-4 py-2 text-left hover:bg-gray-100">
            ➕ Add Project
        </button>
        <button onclick="openModal('createPackageTypeModal'); closeAddDropdown();" class="block w-full px-4 py-2 text-left hover:bg-gray-100">
            ➕ Add Package Type
        </button>
    </div>
</section>

<!-- 📦 Package Types Section -->
<section class="bg-white rounded-lg shadow p-6 mb-8">
    <h3 class="text-lg font-bold mb-4 flex items-center gap-2 text-[#1F2937]">
        📦 <span>Package Types</span>
    </h3>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        @foreach($packageTypes as $type)
            <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 shadow-sm hover:shadow-md transition">
                <div class="text-lg font-bold text-[#1F2937]">{{ $type->package_code }}</div>
                <div class="text-sm text-gray-500 mb-2">{{ $type->description }}</div>
                <ul class="text-sm list-disc list-inside text-gray-700">
                    @foreach($type->contents as $item)
                        <li>{{ $item->quantity }} × {{ $item->item_name }}</li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
</section>

<!-- 📦 Packages Section -->
<section class="bg-white rounded-lg shadow p-6 mb-8">
    <h3 class="text-lg font-bold mb-4 flex items-center gap-2 text-[#1F2937]">
        📦 <span>Packages</span>
    </h3>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        @foreach($packages as $package)
            <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 shadow-sm hover:shadow-md transition">
                <div class="text-sm text-gray-500 mb-1">Project: {{ $package->project->name }}</div>
                <div class="text-lg font-bold text-[#1F2937]">{{ $package->packageType->package_code }}</div>
                <div class="text-sm">Batch: {{ $package->batch }}</div>
                <div class="text-sm">Lot: {{ $package->lot }}</div>
                <div class="text-sm mb-3">Desc: {{ $package->description }}</div>

                <div class="flex gap-2 mt-2">
                    <button
                        onclick="openEditPackageModal(
                            {{ $package->id }},
                            {{ $package->project_id }},
                            {{ $package->package_type_id }},
                            '{{ $package->batch }}',
                            '{{ $package->lot }}',
                            '{{ $package->description }}'
                        )"
                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm"
                    >
                        ✏️ Edit
                    </button>
                    <form action="{{ route('packages.destroy', $package->id) }}" method="POST" onsubmit="return confirm('Delete this package?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm">🗑️ Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</section>

<!-- 📁 Projects Table Section -->
<section class="bg-white rounded-lg shadow p-6 mb-20">
    <h3 class="text-lg font-bold mb-4 flex items-center gap-2 text-[#1F2937]">
        🗂 <span>Projects</span>
    </h3>
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm text-left border border-gray-200">
            <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                <tr>
                    <th class="px-4 py-2 border">Project Name</th>
                    <th class="px-4 py-2 border">Target Delivery</th>
                    <th class="px-4 py-2 border">Target Arrival</th>
                    <th class="px-4 py-2 border">Packages</th>
                    <th class="px-4 py-2 border">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @foreach($projects as $project)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border">{{ $project->name }}</td>
                        <td class="px-4 py-2 border">{{ $project->target_delivery_date ?? '—' }}</td>
                        <td class="px-4 py-2 border">{{ $project->target_arrival_date ?? '—' }}</td>
                        <td class="px-4 py-2 border">
                            @foreach ($project->packages as $package)
                                <div class="mb-2 p-2 bg-gray-100 rounded">
                                    <div class="font-semibold text-sm">{{ $package->packageType->package_code ?? 'N/A' }}</div>
                                    <div class="text-xs text-gray-600">{{ $package->description ?? 'No description' }}</div>
                                </div>
                            @endforeach
                            <button onclick="openModal('createPackageModal_{{ $project->id }}')" class="mt-2 text-blue-500 hover:underline text-xs">
                                + Add Package
                            </button>
                            @include('projects.partials.create-package-modal', ['project' => $project, 'packageTypes' => $packageTypes])
                        </td>
                        <td class="px-4 py-2 border">
                            <button
                                onclick="openEditProjectModal({{ $project->id }}, '{{ $project->name }}', '{{ $project->target_delivery_date }}', '{{ $project->target_arrival_date }}')"
                                class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm">
                                ✏️ Edit
                            </button>
                            <form action="{{ route('projects.destroy', $project->id) }}" method="POST" class="inline-block mt-2" onsubmit="return confirm('Are you sure you want to delete this project?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm">
                                    🗑️ Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>

</main>


    <!-- Modals -->
    @include('projects.partials.create-project-modal')
    @include('projects.partials.create-package-type-modal')
    @include('projects.partials.edit-project-modal')
    @include('projects.partials.edit-package-modal')

</body>
</html>
