<x-app-layout>
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

                        {{-- Status Badge --}}
                        <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full mt-1">
                            {{ $project->status }}
                        </span>

                        {{-- Packages --}}
                        <div class="mt-2">
                            <strong class="text-sm">Packages:</strong>
                            @forelse ($project->packages as $pkg)
                                <span class="inline-block bg-gray-100 text-xs px-2 py-1 rounded mr-1 mt-1">
                                    {{ $pkg->packageType->description ?? 'Unknown Package' }}
                                </span>
                            @empty
                                <span class="text-gray-400 italic text-sm">No packages assigned.</span>
                            @endforelse
                        </div>

                        {{-- Recipient Schools --}}
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

                        {{-- Dates --}}
                        <p class="text-sm text-gray-600 mt-2">
                            📅 Delivery: {{ $project->target_delivery_date }}<br>
                            📦 Arrival: {{ $project->target_arrival_date }}
                        </p>
                    </div>

                    {{-- 🔧 Action Buttons --}}
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

            {{-- Edit Modal for this project --}}
                @include('projects.partials.edit-modal', ['project' => $project])
                @endforeach

            {{-- Create Modal (only once) --}}
                @include('projects.partials.create-modal', [
                    'packageTypes' => $packageTypes,
                    'divisions' => $divisions
            ])
    </div>

    {{-- Modal JS --}}
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
            button.addEventListener('click', (e) => {
                const projectId = button.getAttribute('data-project-id');
                document.getElementById(`editProjectModal-${projectId}`)?.classList.add('hidden');
            });
        });
    </script>
</x-app-layout>
