
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white">
            Projects and Package Types
        </h2>
    </x-slot>

    <div class="p-6 space-y-12">
        <!-- ✅ Add Dropdown Button -->
        <div class="relative mb-6">
            <button onclick="toggleAddDropdown()" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                + Add
            </button>
            <div id="addDropdown" class="absolute z-10 mt-2 bg-white shadow-md rounded hidden w-48">
                <button onclick="openModal('createProjectModal'); closeAddDropdown();" class="w-full text-left px-4 py-2 hover:bg-gray-100">➕ Add Project</button>
                <button onclick="openModal('createPackageTypeModal'); closeAddDropdown();" class="w-full text-left px-4 py-2 hover:bg-gray-100">➕ Add Package Type</button>
            </div>
        </div>

        <!-- 📦 Package Types as Cards -->
        <div>
            <h3 class="text-lg font-semibold mb-3">Package Types</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                @foreach($packageTypes as $type)
                    <div class="bg-white rounded shadow p-4">
                        <div class="text-lg font-bold">{{ $type->package_code }}</div>
                        <div class="text-sm text-gray-600">{{ $type->description }}</div>
                        <ul class="mt-2 list-disc list-inside text-sm">
                            @foreach($type->contents as $item)
                                <li>{{ $item->quantity }} × {{ $item->item_name }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- 📁 Projects Table -->
        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="min-w-full text-sm text-left border border-gray-300 mt-12">
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
                                @foreach ($project->packages as $package)
                                    <div class="mb-2 p-2 bg-gray-100 rounded">
                                        <div class="font-semibold">{{ $package->packageType->package_code ?? 'N/A' }}</div>
                                        <div class="text-xs text-gray-600">{{ $package->description ?? 'No description' }}</div>
                                    </div>
                                @endforeach

                                <button onclick="openModal('createPackageModal_{{ $project->id }}')" class="mt-2 text-blue-500 hover:underline text-xs">
                                    + Add Package
                                </button>

                                @include('projects.partials.create-package-modal', ['project' => $project, 'packageTypes' => $packageTypes])
                            </td>
                            <td class="border px-4 py-2 flex gap-2">
                            <button
                                onclick="openEditProjectModal({{ $project->id }}, '{{ $project->name }}', '{{ $project->target_delivery_date }}', '{{ $project->target_arrival_date }}')"
                                class="bg-yellow-500 text-white px-3 py-1 rounded">
                                Edit
                            </button>

                            <form action="{{ route('projects.destroy', $project->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this project?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded">Delete</button>
                            </form>
                        </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @include('projects.partials.create-project-modal')
    @include('projects.partials.create-package-type-modal')
    @include('projects.partials.edit-project-modal')


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
</x-app-layout>
