<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <title>Projects</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Optional Fade Animations -->
    <style>
        @keyframes fade-in-up {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up {
            animation: fade-in-up 0.4s ease-out forwards;
        }

        @keyframes fade-out-down {
            0% { opacity: 1; transform: translateY(0); }
            100% { opacity: 0; transform: translateY(20px); }
        }
        .animate-fade-out-down {
            animation: fade-out-down 0.4s ease-in forwards;
        }
    </style>
</head>
<body class="bg-gray-100 font-sans">
<div class="flex h-screen relative bg-white">

     <!-- Side Bar -->
     @include('layouts.sidebar')

    <!-- Top Nav Bar -->
    @include('layouts.top-navbar')

    <!-- Main Content -->
<div :class="open ? 'ml-[300px]' : 'ml-20'" class="transition-all duration-300 pt-24 p-8 relative">
    <h2 class="text-[45px] font-bold text-gray-800 mb-6 border-b border-gray-300 pb-2 tracking-wide">
        📦 Projects
    </h2>



    <div class="max-w-7xl mx-auto py-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold">DCP Projects</h2>
            <button id="openAddModalBtn" class="bg-green-600 text-white px-4 py-2 rounded">+ Create Project</button>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
                {{ session('success') }}
            </div>
        @endif

        @foreach ($projects as $project)
            <div class="bg-white p-4 shadow rounded mb-4">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="text-lg font-semibold">{{ $project->name }}</h3>

                        <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full mt-1">
                            {{ $project->status }}
                        </span>

                        <div class="mt-2">
                            <strong class="text-sm">Packages:</strong>
                            @forelse ($project->packages as $pkg)
                                <span class="inline-block bg-gray-100 text-xs px-2 py-1 rounded mr-1 mt-1">
                                    {{ $pkg->packageType->package_code ?? 'Unknown Package' }}
                                </span>
                            @empty
                                <span class="text-gray-400 italic text-sm">No packages assigned.</span>
                            @endforelse
                        </div>

                        <div class="mt-2">
                            <strong class="text-sm">Recipient Schools:</strong>
                            <ul class="list-disc list-inside text-sm text-gray-700">
                                @forelse ($project->schools as $school)
                                    <li>{{ $school->school_name }}</li>
                                @empty
                                    <li class="italic text-gray-400">No schools assigned.</li>
                                @endforelse
                            </ul>
                        </div>

                        <p class="text-sm text-gray-600 mt-2">
                            📅 Delivery: {{ $project->target_delivery_date }}<br>
                            📦 Arrival: {{ $project->target_arrival_date }}
                        </p>
                    </div>

                    <div class="flex flex-col gap-2 items-end">
                        <button onclick="openEditModal({{ $project->id }})"
                            class="text-blue-600 hover:underline">✏️ Edit</button>

                        <form method="POST"
                              action="{{ route('projects.destroy', $project->id) }}"
                              onsubmit="return confirm('Are you sure you want to delete this project?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">🗑️ Delete</button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Edit Modal --}}
            @include('projects.partials.edit-modal', ['project' => $project])
        @endforeach

        {{-- Create Modal --}}
        @include('projects.partials.create-modal', [
            'packageTypes' => $packageTypes,
            'divisions' => $divisions
        ])
    </div>

    <!-- Modal Control Script -->
    <script>
        const addModal = document.getElementById('addProjectModal');
        const openAddBtn = document.getElementById('openAddModalBtn');
        const closeAddBtn = document.getElementById('closeAddProjectModalBtn');

        openAddBtn?.addEventListener('click', () => addModal?.classList.remove('hidden'));
        closeAddBtn?.addEventListener('click', () => addModal?.classList.add('hidden'));

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
</body>
</html>
