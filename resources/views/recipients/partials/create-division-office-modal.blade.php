<!-- Create Division Modal -->
<div id="createDivisionModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-50 hidden justify-center items-center">
    <div class="bg-white w-full max-w-lg rounded-2xl shadow-xl p-6 relative animate-fadeInUp">

        <!-- Close X Button -->
        <button class="absolute top-3 right-3 text-gray-400 hover:text-gray-700 text-2xl transition-colors duration-200"
                onclick="closeModal('createDivisionModal')">&times;</button>

        <!-- Modal Title -->
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">➕ Add New Division</h2>

        <!-- Form -->
        <form id="createDivisionForm" method="POST" action="{{ route('recipients.division.store') }}">
            @csrf

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Division ID</label>
                <input type="number" name="division_id" required
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Division Name</label>
                <input type="text" name="division_name" required
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Regional Office</label>
                <select name="regional_office_id" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
                    <option value="">Select Regional Office</option>
                    @foreach($regionalOffices as $ro)
                        <option value="{{ $ro->ro_id }}">{{ $ro->ro_office }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Office</label>
                <input type="text" name="office" value="{{ old('office', $division->office ?? '') }}"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">SDO Address</label>
                <input type="text" name="sdo_address" value="{{ old('sdo_address', $division->sdo_address ?? '') }}"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Buttons -->
            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeModal('createDivisionModal')"
                        class="bg-gray-200 text-gray-700 px-5 py-2 rounded-lg hover:bg-gray-300 transition">
                    Cancel
                </button>
                <button type="submit"
                        class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition">
                    Save
                </button>
            </div>
        </form>
    </div>
</div>
