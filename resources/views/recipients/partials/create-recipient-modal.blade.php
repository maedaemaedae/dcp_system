<div id="createRecipientModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center transition-opacity duration-300">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-3xl p-8 relative animate-fadeInUp">

        <!-- Close Button -->
        <button onclick="closeModal('createRecipientModal')" class="absolute top-4 right-4 text-gray-400 hover:text-gray-700 text-2xl transition-colors duration-200">&times;</button>

        <!-- Modal Header -->
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">📦 Add Recipient</h2>

        <!-- Form -->
        <form action="{{ route('recipients.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div>
                    <label for="package_id" class="block text-sm font-medium text-gray-700 mb-1">Package</label>
                    <select name="package_id" id="package_id" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @foreach($packages as $package)
                            <option value="{{ $package->id }}">
                                {{ $package->packageType->package_code }} - {{ $package->description }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="quantity" class="block text-sm font-medium text-gray-700 mb-1">Quantity</label>
                    <input type="number" name="quantity" id="quantity" min="1" required
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label for="recipient_type" class="block text-sm font-medium text-gray-700 mb-1">Recipient Type</label>
                    <select name="recipient_type" id="recipient_type" onchange="toggleRecipientOptions(this.value)"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="school">School</option>
                        <option value="division">Division</option>
                    </select>
                </div>

                <div id="schoolRecipient" class="md:col-span-2">
                    <label for="school_id" class="block text-sm font-medium text-gray-700 mb-1">Select School</label>
                    <select name="recipient_id" id="school_id" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @foreach($schools as $school)
                            <option value="{{ $school->school_id }}">{{ $school->school_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div id="divisionRecipient" class="md:col-span-2 hidden">
                    <label for="division_id" class="block text-sm font-medium text-gray-700 mb-1">Select Division</label>
                    <select name="recipient_id" id="division_id" disabled
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @foreach($divisions as $division)
                            <option value="{{ $division->division_id }}">{{ $division->division_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="md:col-span-2">
                    <label for="contact_person" class="block text-sm font-medium text-gray-700 mb-1">Contact Person</label>
                    <input type="text" name="contact_person" id="contact_person"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>

                <div>
                    <label for="position" class="block text-sm font-medium text-gray-700 mb-1">Position</label>
                    <input type="text" name="position" id="position"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label for="contact_number" class="block text-sm font-medium text-gray-700 mb-1">Contact Number</label>
                    <input type="text" name="contact_number" id="contact_number"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

            </div>

            <!-- Buttons -->
            <div class="mt-8 flex justify-end gap-3">
                <button type="button" onclick="closeModal('createRecipientModal')"
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
