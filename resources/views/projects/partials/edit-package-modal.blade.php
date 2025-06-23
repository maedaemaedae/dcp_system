<!-- Edit Package Modal -->
<div id="editPackageModal" class="hidden fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 transition-opacity duration-300">
    <div class="bg-white p-6 rounded-2xl w-full max-w-md shadow-xl relative animate-fadeInUp">
        
        <!-- Close Button -->
        <button onclick="closeModal('editPackageModal')" class="absolute top-4 right-4 text-gray-400 hover:text-gray-700 text-2xl transition-colors duration-200">&times;</button>

        <form id="editPackageForm" method="POST">
            @csrf
            @method('PUT')

            <h2 class="text-2xl font-semibold text-gray-800 mb-6">📦 Edit Package</h2>
           
            <label class="block text-sm font-medium text-gray-700 mb-1">Project</label>
            <select name="project_id" id="editProjectId" class="w-full mb-4 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                @foreach ($projects as $project)
                    <option value="{{ $project->id }}">{{ $project->name }}</option>
                @endforeach
            </select>

            <label class="block text-sm font-medium text-gray-700 mb-1">Package Type</label>
            <select name="package_type_id" id="editPackageTypeId" class="w-full mb-4 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @foreach($packageTypes as $type)
                    <option value="{{ $type->id }}">{{ $type->package_code }}</option>
                @endforeach
            </select>

            <label class="block text-sm font-medium text-gray-700 mb-1">Batch</label>
            <input type="text" name="batch" id="editBatch" class="w-full mb-4 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">

            <label class="block text-sm font-medium text-gray-700 mb-1">Lot</label>
            <input type="text" name="lot" id="editLot" class="w-full mb-4 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">

            <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
            <textarea name="description" id="editDescription" rows="3" class="w-full mb-6 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none"></textarea>

            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeModal('editPackageModal')"
                        class="bg-gray-200 text-gray-700 px-6 py-2 rounded-lg font-semibold shadow hover:bg-gray-300 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-gray-400">
                    Cancel
                </button>
                <button type="submit"
                        class="bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold shadow hover:bg-blue-700 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-400">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openEditPackageModal(id, projectId, typeId, batch, lot, description) {
    const form = document.getElementById('editPackageForm');
    form.action = `/packages/${id}`;
    document.getElementById('editProjectId').value = projectId;
    document.getElementById('editPackageTypeId').value = typeId;
    document.getElementById('editBatch').value = batch;
    document.getElementById('editLot').value = lot;
    document.getElementById('editDescription').value = description;
    document.getElementById('editPackageModal').classList.remove('hidden');
}
</script>
