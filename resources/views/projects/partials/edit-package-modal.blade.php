<!-- Edit Package Modal -->
<div id="editPackageModal" class="hidden fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg w-full max-w-md">
        <form id="editPackageForm" method="POST">
            @csrf
            @method('PUT')
            <h2 class="text-xl font-semibold mb-4">Edit Package</h2>

            <label class="block mb-1 font-medium">Package Type</label>
            <select name="package_type_id" id="editPackageTypeId" class="w-full mb-3 border px-3 py-2 rounded">
                @foreach($packageTypes as $type)
                    <option value="{{ $type->id }}">{{ $type->package_code }}</option>
                @endforeach
            </select>

            <label class="block mb-1 font-medium">Batch</label>
            <input type="text" name="batch" id="editBatch" class="w-full mb-3 border px-3 py-2 rounded">

            <label class="block mb-1 font-medium">Lot</label>
            <input type="text" name="lot" id="editLot" class="w-full mb-3 border px-3 py-2 rounded">

            <label class="block mb-1 font-medium">Description</label>
            <textarea name="description" id="editDescription" class="w-full mb-4 border px-3 py-2 rounded"></textarea>

            <div class="flex justify-end space-x-2">
                <button type="button" onclick="closeModal('editPackageModal')" class="bg-gray-400 text-white px-4 py-2 rounded">Cancel</button>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
            </div>
        </form>
    </div>
</div>

<script>
function openEditPackageModal(id, typeId, batch, lot, description) {
    const form = document.getElementById('editPackageForm');
    form.action = `/packages/${id}`;
    document.getElementById('editPackageTypeId').value = typeId;
    document.getElementById('editBatch').value = batch;
    document.getElementById('editLot').value = lot;
    document.getElementById('editDescription').value = description;
    document.getElementById('editPackageModal').classList.remove('hidden');
}
</script>
