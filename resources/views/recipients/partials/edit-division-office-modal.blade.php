<!-- Edit Division Modal -->
<div id="editDivisionModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center transition-opacity duration-300">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-3xl p-8 relative animate-fadeInUp font-['Poppins']">

        <!-- Close Button -->
        <button onclick="closeModal('editDivisionModal')"
                class="absolute top-4 right-4 text-gray-400 hover:text-gray-700 text-2xl transition-colors duration-200">&times;</button>

        <!-- Header -->
        <h2 class="text-2xl font-semibold text-gray-800 mb-6"> Edit Division</h2>

        <!-- Form -->
        <form id="editDivisionForm" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Division Name -->
                <div class="md:col-span-2">
                    <label for="editDivisionName" class="block text-sm font-medium text-gray-700 mb-1">Division Name</label>
                    <input type="text" name="division_name" id="editDivisionName"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>

                <!-- Regional Office -->
                <div>
                    <label for="editRegionalOfficeId" class="block text-sm font-medium text-gray-700 mb-1">Regional Office</label>
                    <select name="regional_office_id" id="editRegionalOfficeId"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @foreach($regionalOffices as $ro)
                            <option value="{{ $ro->ro_id }}">{{ $ro->ro_office }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Office -->
                <div>
                    <label for="editOffice" class="block text-sm font-medium text-gray-700 mb-1">Office</label>
                    <input type="text" id="editOffice" name="office"
                           value="{{ old('office', $division->office ?? '') }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>

                <!-- SDO Address -->
                <div class="md:col-span-2">
                    <label for="editSdoAddress" class="block text-sm font-medium text-gray-700 mb-1">SDO Address</label>
                    <input type="text" id="editSdoAddress" name="sdo_address"
                           value="{{ old('sdo_address', $division->sdo_address ?? '') }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>
            </div>

            <!-- Buttons -->
            <div class="mt-8 flex justify-end gap-3">
                <button type="button" onclick="closeModal('editDivisionModal')"
                        class="bg-gray-200 text-gray-700 px-6 py-2 rounded-lg font-semibold shadow hover:bg-gray-300 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-gray-400">
                    Cancel
                </button>
                <button type="submit"
                        class="bg-[#7C3AED] text-white px-6 py-2 rounded-lg font-semibold shadow hover:bg-[#6B21A8] transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-400">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>
