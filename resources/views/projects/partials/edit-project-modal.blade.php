<!-- resources/views/projects/partials/edit-project-modal.blade.php -->
<div id="editProjectModal" class="hidden fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg w-full max-w-md">
        <form id="editProjectForm" method="POST">
            @csrf
            @method('PUT')
            <h2 class="text-xl font-semibold mb-4">Edit Project</h2>

            <label class="block mb-1 font-medium">Project Name</label>
            <input type="text" name="name" id="editProjectName" class="w-full border px-3 py-2 mb-3 rounded">

            <label class="block mb-1 font-medium">Target Delivery Date</label>
            <input type="date" name="target_delivery_date" id="editTargetDeliveryDate" class="w-full border px-3 py-2 mb-3 rounded">

            <label class="block mb-1 font-medium">Target Arrival Date</label>
            <input type="date" name="target_arrival_date" id="editTargetArrivalDate" class="w-full border px-3 py-2 mb-3 rounded">

            <div class="flex justify-end space-x-2">
                <button type="button" onclick="closeModal('editProjectModal')" class="px-4 py-2 bg-gray-400 text-white rounded">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Update</button>
            </div>
        </form>
    </div>
</div>

<script>
function openEditProjectModal(id, name, deliveryDate, arrivalDate) {
    const form = document.getElementById('editProjectForm');
    form.action = `/projects/${id}`;
    document.getElementById('editProjectName').value = name;
    document.getElementById('editTargetDeliveryDate').value = deliveryDate;
    document.getElementById('editTargetArrivalDate').value = arrivalDate;
    document.getElementById('editProjectModal').classList.remove('hidden');
}

function closeModal(modalId) {
    document.getElementById(modalId).classList.add('hidden');
}
</script>
