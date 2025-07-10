<!-- Create School Modal -->
<div id="createSchoolModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-50 hidden justify-center items-center transition-opacity duration-300">
    <div class="bg-white w-full max-w-3xl rounded-2xl shadow-xl p-8 relative animate-fadeInUp">

        <!-- Close Button -->
        <button class="absolute top-4 right-4 text-gray-400 hover:text-gray-700 text-2xl transition-colors duration-200"
                onclick="closeModal('createSchoolModal')">&times;</button>

        <!-- Modal Header -->
        <h2 class="text-2xl font-semibold text-gray-800 mb-6"> Add New School</h2>

        <!-- Form -->
        <form id="createSchoolForm" method="POST" action="{{ route('recipients.school.store') }}">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Region</label>
                    <select name="regional_office_id" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
                        <option value="">Select Regional Office</option>
                        @foreach($regionalOffices as $ro)
                            <option value="{{ $ro->ro_id }}">{{ $ro->ro_office }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Division</label>
                    <select name="division_id" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500" required>
                        <option value="">Select Division</option>
                        @foreach($divisions as $division)
                            <option value="{{ $division->division_id }}">{{ $division->division_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">School ID</label>
                    <input type="number" name="school_id" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">School Name</label>
                    <input type="text" name="school_name" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">School Address</label>
                    <input type="text" name="school_address" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Connected to Internet?</label>
                    <select name="has_internet" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
                        <option value="1">Yes</option>
                        <option value="0" selected>No</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Internet Provider</label>
                    <input type="text" name="internet_provider" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="md:col-span-2 md:w-1/2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Electricity Provider</label>
                    <input type="text" name="electricity_provider" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="mt-8 flex justify-end gap-3">
                <button type="button" onclick="closeModal('createSchoolModal')"
                    class="bg-gray-200 text-gray-700 px-6 py-2 rounded-lg font-semibold shadow hover:bg-gray-300 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-gray-400">
                    Cancel
                </button>
                <button type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold shadow hover:bg-blue-700 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-400">
                    Save
                </button>
            </div>
        </form>
    </div>
</div>
