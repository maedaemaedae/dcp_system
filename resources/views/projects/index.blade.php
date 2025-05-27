
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white">
            Project and Package Management
        </h2>
    </x-slot>

    <div class="p-6 space-y-12">
        <!-- Add Project Button -->
        <div class="flex justify-end mb-4">
            <button onclick="openModal('createProjectModal')" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                + Add Project
            </button>
        </div>

        <!-- Project Table -->
        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="min-w-full text-sm text-left border border-gray-300">
                <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                    <tr>
                        <th class="px-4 py-2 border">Project Name</th>
                        <th class="px-4 py-2 border">Target Delivery</th>
                        <th class="px-4 py-2 border">Target Arrival</th>
                        <th class="px-4 py-2 border">Packages</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($projects as $project)
                        <tr>
                            <td class="px-4 py-2 border">{{ $project->name }}</td>
                            <td class="px-4 py-2 border">{{ $project->target_delivery_date ?? '—' }}</td>
                            <td class="px-4 py-2 border">{{ $project->target_arrival_date ?? '—' }}</td>
                            <td class="px-4 py-2 border">
                                @foreach($project->packages as $package)
                                    <div class="mb-2 p-2 bg-gray-100 rounded">
                                        <div class="font-semibold">{{ $package->packageType->package_code ?? 'N/A' }}</div>
                                        <div class="text-xs text-gray-600">{{ $package->description ?? 'No description' }}</div>
                                    </div>
                                @endforeach

                                <button onclick="openModal('createPackageModal_{{ $project->id }}')" class="mt-2 text-blue-500 hover:underline text-xs">
                                    + Add Package
                                </button>

                                @include('projects.partials.create-package-modal', ['project' => $project])
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @include('projects.partials.create-project-modal')


    <script>
    function openModal(id) {
        const modal = document.getElementById(id);
        if (modal) {
            modal.classList.remove('hidden');
        }
    }

    function closeModal(id) {
        const modal = document.getElementById(id);
        if (modal) {
            modal.classList.add('hidden');
        }
    }
</script>

</x-app-layout>
