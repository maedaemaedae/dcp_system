<!-- Edit School Modal -->
<div id="editSchoolModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center transition-opacity duration-300">
    <div class="bg-white w-full max-w-3xl rounded-2xl shadow-xl p-8 relative animate-fadeInUp font-['Poppins']">

        <!-- Close Button -->
        <button onclick="closeModal('editSchoolModal')"
                class="absolute top-4 right-4 text-gray-400 hover:text-gray-700 text-2xl transition-colors duration-200">&times;</button>

        <!-- Header -->
        <h2 class="text-2xl font-semibold text-gray-800 mb-6"> Edit School</h2>

        <!-- Form -->
        <form id="editSchoolForm" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- School ID (readonly) -->
                <div class="md:col-span-2">
                    <label for="editSchoolId" class="block text-sm font-medium text-gray-700 mb-1">School ID</label>
                    <input type="text" name="school_id" id="editSchoolId" readonly
                           class="w-full border border-gray-300 bg-gray-100 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- School Name -->
                <div>
                    <label for="editSchoolName" class="block text-sm font-medium text-gray-700 mb-1">School Name</label>
                    <input type="text" name="school_name" id="editSchoolName"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- School Address -->
                <div>
                    <label for="editSchoolAddress" class="block text-sm font-medium text-gray-700 mb-1">School Address</label>
                    <input type="text" name="school_address" id="editSchoolAddress"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Division -->
                <div>
                    <label for="editDivisionId" class="block text-sm font-medium text-gray-700 mb-1">Division</label>
                    <select name="division_id" id="editDivisionId"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @foreach($divisions as $division)
                            <option value="{{ $division->division_id }}">{{ $division->division_name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Has Internet -->
                <div>
                    <label for="editHasInternet" class="block text-sm font-medium text-gray-700 mb-1">Connected to Internet?</label>
                    <select name="has_internet" id="editHasInternet"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>

                <!-- Internet Provider -->
                <div>
                    <label for="editInternetProvider" class="block text-sm font-medium text-gray-700 mb-1">Internet Provider</label>
                    <input type="text" name="internet_provider" id="editInternetProvider"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Electricity Provider -->
                <div>
                    <label for="editElectricityProvider" class="block text-sm font-medium text-gray-700 mb-1">Electricity Provider</label>
                    <input type="text" name="electricity_provider" id="editElectricityProvider"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <!-- Buttons -->
            <div class="mt-8 flex justify-end gap-3">
                <button type="button" onclick="closeModal('editSchoolModal')"
                        class="bg-gray-200 text-gray-700 px-6 py-2 rounded-lg font-semibold shadow hover:bg-gray-300 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-gray-400">
                    Cancel
                </button>
                <button type="submit"
                        class="bg-[#10B981] text-white px-6 py-2 rounded-lg font-semibold shadow hover:bg-[#059669] transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-green-400">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>
