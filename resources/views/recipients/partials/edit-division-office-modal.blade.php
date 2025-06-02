<!-- Edit Division Modal -->
<div id="editDivisionModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-50 hidden justify-center items-center">
    <div class="bg-white w-full max-w-lg rounded-lg shadow-lg p-6 relative">
        <h2 class="text-xl font-semibold mb-4">Edit Division</h2>

        <form id="editDivisionForm" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="block text-sm font-medium">Division Name</label>
                <input type="text" name="division_name" id="editDivisionName" class="w-full border rounded px-3 py-2">
            </div>

            <div class="mb-3">
                <label class="block text-sm font-medium">Regional Office</label>
                <select name="regional_office_id" id="editRegionalOfficeId" class="w-full border rounded px-3 py-2">
                    @foreach($regionalOffices as $ro)
                        <option value="{{ $ro->ro_id }}">{{ $ro->ro_office }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block font-medium">Office</label>
                <input type="text" name="office" value="{{ old('office', $division->office ?? '') }}" class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block font-medium">SDO Address</label>
                <input type="text" name="sdo_address" value="{{ old('sdo_address', $division->sdo_address ?? '') }}" class="w-full border rounded px-3 py-2">
            </div>

            <div class="flex justify-end gap-2 mt-4">
                <button type="button" onclick="closeModal('editDivisionModal')" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Update</button>
            </div>
        </form>

        <button class="absolute top-2 right-2 text-gray-500 hover:text-gray-700" onclick="closeModal('editDivisionModal')">&times;</button>
    </div>
</div>
