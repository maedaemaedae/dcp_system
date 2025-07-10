<div id="createRegionalModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden transition-opacity duration-300">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-3xl p-8 relative animate-fadeInUp">
        
        <!-- Close Button -->
        <button id="closeAddModalBtn" class="absolute top-4 right-4 text-gray-400 hover:text-gray-700 text-2xl transition-colors duration-200">&times;</button>
        
        <!-- Modal Header -->
        <h2 class="text-2xl font-semibold text-gray-800 mb-6"> Add Regional Office</h2>

        <!-- Form -->
        <form method="POST" action="{{ route('regional-offices.store') }}">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">RO ID</label>
                    <input type="number" name="ro_id" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Office Name</label>
                    <input type="text" name="ro_office" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">RO Address</label>
                    <input type="text" name="ro_address" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Person in Charge</label>
                    <input type="text" name="person_in_charge" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="md:col-span-2 md:w-1/2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Contact Number</label>
                    <input type="text" name="contact_no" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <div class="mt-8 flex justify-end gap-3">
                <button type="button" onclick="closeModal('createRegionalModal')"
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
