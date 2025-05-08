<div id="editProjectModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white p-6 rounded shadow-lg w-full max-w-2xl relative">
        <button id="closeEditProjectModalBtn" class="absolute top-2 right-2 text-gray-500 text-xl hover:text-black">&times;</button>
        <h2 class="text-xl font-semibold mb-4">Edit Project</h2>

        <form method="POST" action="{{ route('projects.update', ['project' => '__PROJECT_ID__']) }}">
            @csrf
            @method('PUT')

            <input type="hidden" name="project_id" id="editProjectId">

            <div class="mb-4">
                <label class="block font-medium">Project Name</label>
                <input name="name" id="editProjectName" type="text" class="w-full border px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label class="block font-medium">Package Contents</label>
                <select name="package_types[]" id="editPackageTypes" class="w-full border px-3 py-2" multiple required>
                    @foreach ($packageTypes as $package)
                        <option value="{{ $package->id }}">{{ $package->package_code }} - {{ $package->description }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block font-medium">Target Delivery Date</label>
                <input name="target_delivery_date" id="editDeliveryDate" type="date" class="w-full border px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label class="block font-medium">Target Arrival Date</label>
                <input name="target_arrival_date" id="editArrivalDate" type="date" class="w-full border px-3 py-2" required>
            </div>

            <div class="text-right">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update Project</button>
            </div>
        </form>
    </div>
</div>
