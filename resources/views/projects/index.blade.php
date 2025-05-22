<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <title>Projects</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    
</head>
<body class="bg-white-100">
<div class="flex h-screen relative bg-white">

     <!-- Side Bar -->
     @include('layouts.sidebar')

    <!-- Top Nav Bar -->
    @include('layouts.top-navbar')

    <!-- Main Content -->
<div :class="open ? 'ml-[300px]' : 'ml-20'" class="transition-all duration-300 pt-24 p-8 relative">
    <h2 class="text-[45px] font-bold text-gray-800 mb-6 border-b border-gray-300 pb-2 tracking-wide">
        📁 DCP Projects
    </h2>


    <div class="max-w-7xl mx-auto py-6">
    <!-- Top Bar with Button -->
    <div class="flex justify-between items-center mb-4">
        <button 
            id="openAddModalBtn" 
            class="bg-[#4A90E2] hover:bg-[#357ABD] text-white font-medium px-6 py-2.5 rounded-full shadow-md hover:shadow-lg transition-all duration-300 ease-in-out flex items-center space-x-2">
            <i class="fas fa-plus"></i>
            <span>Create Project</span>
        </button>
    </div>


   <!-- Projects List Wrapper -->
<div class="flex justify-center">
    <!-- Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6 place-items-stretch">
        @foreach ($projects as $project)
        <!-- Project Card -->
        <div class="bg-white p-6 shadow-lg rounded-xl border border-gray-100 transition-all duration-300 ease-in-out hover:shadow-2xl hover:border-[#4A90E2] flex flex-col justify-between min-h-[260px]">
            <div class="flex justify-between items-start mb-4">
                <div class="flex-1">
                    <!-- Card Content -->
                    <h3 class="text-xl font-semibold text-gray-800">{{ $project->name }}</h3>

                        @php
                            $status = strtolower($project->status);
                            $statusClasses = match($status) {
                                'delivered' => 'bg-green-100 text-green-800',
                                'pending' => 'bg-orange-100 text-orange-800',
                                'cancelled' => 'bg-red-100 text-red-800',
                                'in progress' => 'bg-blue-100 text-blue-800',
                                default => 'bg-gray-100 text-gray-800',
                            };
                        @endphp

                        <span class="inline-block {{ $statusClasses }} text-xs px-2 py-1 rounded-full mt-1">
                            {{ $project->status }}
                        </span>

                    <div class="mt-2 text-sm">
                        <p class="font-semibold text-gray-700">Packages:</p>
                        @forelse ($project->packages as $pkg)
                            <span class="inline-block bg-gray-100 text-xs px-2 py-1 rounded mr-1 mt-1">
                                {{ $pkg->packageType->package_code ?? 'Unknown' }}
                            </span>
                        @empty
                            <span class="text-gray-400 italic">No packages</span>
                        @endforelse
                    </div>

                   <div class="mt-4">
                        <h4 class="text-sm font-semibold text-[#033372] mb-2">Associated Schools</h4>

                        @if($project->schools->isNotEmpty())
                            <ul class="space-y-1 pl-4 border-l-2 border-blue-200">
                                @foreach ($project->schools as $school)
                                    <li class="relative pl-2 text-gray-700 before:content-['•'] before:absolute before:left-0 before:text-blue-500">
                                        {{ $school->school_name }}
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-gray-400 italic text-sm">No schools assigned</p>
                        @endif
                    </div>


                    <p class="text-xs text-gray-500 mt-2 leading-tight">
                        📅 Delivery: {{ $project->target_delivery_date }}<br>
                        📦 Arrival: {{ $project->target_arrival_date }}
                    </p>
                </div>

                <div class="flex flex-col gap-2 ml-4">
                    <button 
                        onclick="openEditModal({{ $project->id }})"
                        class="px-4 py-1.5 rounded-full bg-[#4A90E2] text-white hover:bg-[#357ABD] transition duration-200 ease-in-out shadow-md text-sm font-medium"
                        title="Edit">
                        Edit
                    </button>

                    <form method="POST" action="{{ route('projects.destroy', $project->id) }}" onsubmit="return confirm('Are you sure you want to delete this project?')">
                        @csrf
                        @method('DELETE')
                        <button 
                            type="submit"
                            class="px-4 py-1.5 rounded-full border border-red-500 text-red-500 hover:bg-red-500 hover:text-white transition duration-200 ease-in-out text-sm font-medium shadow-md">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>

        @include('projects.partials.edit-modal', ['project' => $project])
        @endforeach
    </div>
</div>

        {{-- Create Modal --}}
        @include('projects.partials.create-modal', [
            'packageTypes' => $packageTypes,
            'divisions' => $divisions
        ])
    </div>

 
    <div class="mt-6">
    {{ $projects->links('vendor.pagination.tailwind') }}
</div>





    <!-- Modal Control Script -->
    <script>
        const addModal = document.getElementById('addProjectModal');
        const openAddBtn = document.getElementById('openAddModalBtn');
        const closeAddBtn = document.getElementById('closeAddProjectModalBtn');        

        openAddBtn?.addEventListener('click', () => addModal?.classList.remove('hidden'));
        closeAddBtn?.addEventListener('click', () => addModal?.classList.add('hidden'));

        function closeEditModal(id) {
        const modal = document.getElementById(`editProjectModal-${id}`);
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

        function openEditModal(projectId) {
            const modal = document.getElementById(`editProjectModal-${projectId}`);
            modal?.classList.remove('hidden');
        }

        document.querySelectorAll('[id^="closeEditProjectModalBtn-"]').forEach(button => {
            button.addEventListener('click', () => {
                const projectId = button.getAttribute('data-project-id');
                document.getElementById(`editProjectModal-${projectId}`)?.classList.add('hidden');
            });
        });
    </script>

<style>
@keyframes fade-in-up {
    0% { opacity: 0; transform: translateY(20px); }
    100% { opacity: 1; transform: translateY(0); }
}
@keyframes fade-out-down {
    0% { opacity: 1; transform: translateY(0); }
    100% { opacity: 0; transform: translateY(20px); }
}
.animate-fade-in-up {
    animation: fade-in-up 0.4s ease-out forwards;
}
.animate-fade-out-down {
    animation: fade-out-down 0.4s ease-in forwards;
}
</style>

    </body>
</html>
