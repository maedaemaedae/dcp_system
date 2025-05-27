
<div id="createProjectModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-xl p-6">
        <h2 class="text-xl font-semibold mb-4">Add Project</h2>
        <form action="{{ route('projects.store') }}" method="POST">
            @csrf

            <div class="space-y-4">
                <div>
                    <label for="name" class="block font-medium text-sm text-gray-700">Project Name</label>
                    <input type="text" name="name" id="name" class="w-full border-gray-300 rounded" required>
                </div>

                <div>
                    <label for="target_delivery_date" class="block font-medium text-sm text-gray-700">Target Delivery Date</label>
                    <input type="date" name="target_delivery_date" id="target_delivery_date" class="w-full border-gray-300 rounded">
                </div>

                <div>
                    <label for="target_arrival_date" class="block font-medium text-sm text-gray-700">Target Arrival Date</label>
                    <input type="date" name="target_arrival_date" id="target_arrival_date" class="w-full border-gray-300 rounded">
                </div>
            </div>

            <div class="mt-6 flex justify-end space-x-2">
                <button type="button" onclick="closeModal('createProjectModal')" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Create</button>
            </div>
        </form>
    </div>
</div>
