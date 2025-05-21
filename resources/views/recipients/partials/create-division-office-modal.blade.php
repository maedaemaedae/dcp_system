<!-- Create Division Modal -->
<div id="createDivisionModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-50 hidden justify-center items-center">
    <div class="bg-white w-full max-w-lg rounded-lg shadow-lg p-6 relative">
        <h2 class="text-xl font-semibold mb-4">Add New Division</h2>

        <form id="createDivisionForm" method="POST" action="{{ route('recipients.division.store') }}">
            @csrf
            
            <div class="mb-3">
                <label class="block text-sm font-medium">Division ID</label>
                <input type="number" name="division_id" required class="w-full border rounded px-3 py-2">
            </div>

            <div class="mb-3">
                <label class="block text-sm font-medium">Division Name</label>
                <input type="text" name="division_name" required class="w-full border rounded px-3 py-2">
            </div>

            <div class="mb-3">
                <label class="block text-sm font-medium">Regional Office</label>
                <select name="regional_office_id" class="w-full border rounded px-3 py-2" required>
                    <option value="">Select Regional Office</option>
                    @foreach($regionalOffices as $ro)
                        <option value="{{ $ro->ro_id }}">{{ $ro->ro_office }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex justify-end gap-2 mt-4">
                <button type="button" onclick="closeModal('createDivisionModal')" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Save</button>
            </div>
        </form>

        <!-- Close Button -->
        <button class="absolute top-2 right-2 text-gray-500 hover:text-gray-700" onclick="closeModal('createDivisionModal')">&times;</button>
    </div>
</div>
