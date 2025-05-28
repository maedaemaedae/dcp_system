<div id="createRecipientModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-2xl p-6">
        <h2 class="text-xl font-semibold mb-4">Add Recipient</h2>
        <form action="{{ route('recipients.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="package_id" class="block font-medium text-sm text-gray-700">Package</label>
                    <select name="package_id" id="package_id" class="w-full border-gray-300 rounded">
                        @foreach($packages as $package)
                            <option value="{{ $package->id }}">
                                {{ $package->packageType->package_code }} - {{ $package->description }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="recipient_type" class="block font-medium text-sm text-gray-700">Recipient Type</label>
                    <select name="recipient_type" id="recipient_type" class="w-full border-gray-300 rounded" onchange="toggleRecipientOptions(this.value)">
                        <option value="school">School</option>
                        <option value="division">Division</option>
                    </select>
                </div>

                <div id="schoolRecipient" class="col-span-1 md:col-span-2">
                    <label for="school_id" class="block font-medium text-sm text-gray-700">Select School</label>
                    <select name="recipient_id" id="school_id" class="w-full border-gray-300 rounded">
                        @foreach($schools as $school)
                            <option value="{{ $school->school_id }}">{{ $school->school_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div id="divisionRecipient" class="col-span-1 md:col-span-2 hidden">
                    <label for="division_id" class="block font-medium text-sm text-gray-700">Select Division</label>
                    <select name="recipient_id" id="division_id" class="w-full border-gray-300 rounded" disabled>
                        @foreach($divisions as $division)
                            <option value="{{ $division->id }}">{{ $division->division_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-span-1 md:col-span-2">
                    <label for="notes" class="block font-medium text-sm text-gray-700">Notes</label>
                    <textarea name="notes" id="notes" rows="3" class="w-full border-gray-300 rounded"></textarea>
                </div>
            </div>

            <div class="mt-6 flex justify-end space-x-2">
                <button type="button" onclick="closeModal('createRecipientModal')" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Save</button>
            </div>
        </form>
    </div>
</div>

<script>
    function toggleRecipientOptions(type) {
        const schoolSection = document.getElementById('schoolRecipient');
        const divisionSection = document.getElementById('divisionRecipient');
        const schoolSelect = document.getElementById('school_id');
        const divisionSelect = document.getElementById('division_id');

        if (type === 'school') {
            schoolSection.classList.remove('hidden');
            divisionSection.classList.add('hidden');
            schoolSelect.disabled = false;
            divisionSelect.disabled = true;
        } else {
            schoolSection.classList.add('hidden');
            divisionSection.classList.remove('hidden');
            schoolSelect.disabled = true;
            divisionSelect.disabled = false;
        }
    }

    // run once on page load to ensure correct state
    window.addEventListener('DOMContentLoaded', () => {
        toggleRecipientOptions(document.getElementById('recipient_type').value);
    });
</script>
