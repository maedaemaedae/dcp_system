<div id="editProjectModal" class="hidden fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 transition-opacity duration-300">
    <div class="bg-white p-6 rounded-2xl w-full max-w-md shadow-xl relative animate-fadeInUp">
        
        <!-- Close Button -->
        <button onclick="closeModal('editProjectModal')" class="absolute top-4 right-4 text-gray-400 hover:text-gray-700 text-2xl transition duration-200">&times;</button>

        <form id="editProjectForm" method="POST">
            @csrf
            @method('PUT')

            <h2 class="text-2xl font-semibold text-gray-800 mb-6">📁 Edit Project</h2>

            <label class="block text-sm font-medium text-gray-700 mb-1">Project Name</label>
            <input type="text" name="name" id="editProjectName" class="w-full mb-4 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>

            <label class="block text-sm font-medium text-gray-700 mb-1">Target Delivery Date</label>
            <input type="date" name="target_delivery_date" id="editTargetDeliveryDate" class="w-full mb-4 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">

            <label class="block text-sm font-medium text-gray-700 mb-1">Target Arrival Date</label>
            <input type="date" name="target_arrival_date" id="editTargetArrivalDate" class="w-full mb-6 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">

            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeModal('editProjectModal')" class="bg-gray-200 text-gray-700 px-6 py-2 rounded-lg font-semibold hover:bg-gray-300 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-gray-400">
                    Cancel
                </button>
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-blue-700 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-400">
                    Update
                </button>
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
