<x-app-layout>
    <div class="max-w-7xl mx-auto py-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold">DCP Projects</h2>
            <button id="openAddModalBtn" class="bg-green-600 text-white px-4 py-2 rounded">+ Create Project</button>
        </div>

        @foreach ($projects as $project)
            <div class="bg-white p-4 shadow rounded mb-4">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-lg font-semibold">{{ $project->name }}</h3>
                        <p class="text-sm text-gray-600">
                            Delivery: {{ $project->target_delivery_date }}<br>
                            Arrival: {{ $project->target_arrival_date }}
                        </p>
                        <div class="mt-2">
                            @foreach ($project->packages as $pkg)
                                <span class="inline-block bg-gray-100 text-xs px-2 py-1 rounded mr-1">
                                    {{ $pkg->packageType->package_code }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                    <div class="flex gap-2 items-center">
                        <button onclick="openEditModal({{ $project->id }})" class="text-blue-600 hover:underline">Edit</button>
                        <form method="POST" action="{{ route('projects.destroy', $project->id) }}" onsubmit="return confirm('Are you sure you want to delete this project?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Delete</button>
                        </form>
                    </div>
                </div>
            </div>

            @include('projects.partials.edit-modal', ['project' => $project])
        @endforeach
    </div>

    @include('projects.partials.create-modal')

    <script>
        const addModal = document.getElementById('addProjectModal');
        const openAddBtn = document.getElementById('openAddModalBtn');
        const closeAddBtn = document.getElementById('closeAddProjectModalBtn');

        openAddBtn?.addEventListener('click', () => addModal.classList.remove('hidden'));
        closeAddBtn?.addEventListener('click', () => addModal.classList.add('hidden'));

        function openEditModal(projectId) {
            const modal = document.getElementById('editProjectModal');
            modal.classList.remove('hidden');
            // You can expand this function to auto-fill fields if needed
        }

        const closeEditBtn = document.getElementById('closeEditProjectModalBtn');
        closeEditBtn?.addEventListener('click', () => {
            document.getElementById('editProjectModal')?.classList.add('hidden');
        });
    </script>
</x-app-layout>
