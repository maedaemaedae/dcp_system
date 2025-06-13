<div id="editRegionalModal-{{ $ro->ro_id }}" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center transition-opacity duration-300">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-3xl p-8 relative animate-fadeInUp">

        <!-- Close Button -->
        <button onclick="closeEditModal({{ $ro->ro_id }})"
                class="absolute top-4 right-4 text-gray-400 hover:text-gray-700 text-2xl transition-colors duration-200">&times;</button>

        <!-- Header -->
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">📝 Edit Regional Office</h2>

        <!-- Form -->
        <form method="POST" action="{{ route('regional-offices.update', $ro->ro_id) }}">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">RO ID</label>
                    <input type="text" value="{{ $ro->ro_id }}" readonly
                        class="w-full border border-gray-300 bg-gray-100 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Office Name</label>
                    <input type="text" name="ro_office" value="{{ $ro->ro_office }}" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Person in Charge</label>
                    <input type="text" name="person_in_charge" value="{{ $ro->person_in_charge }}" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">RO Address</label>
                    <input type="text" name="ro_address" value="{{ $ro->ro_address }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" value="{{ $ro->email }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Contact No.</label>
                    <input type="text" name="contact_no" value="{{ $ro->contact_no }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <!-- Buttons -->
            <div class="mt-8 flex justify-end gap-3">
                <button type="button" onclick="closeEditModal({{ $ro->ro_id }})"
                    class="bg-gray-200 text-gray-700 px-6 py-2 rounded-lg font-semibold shadow hover:bg-gray-300 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-gray-400">
                    Cancel
                </button>
                <button type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold shadow hover:bg-blue-700 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-400">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>
