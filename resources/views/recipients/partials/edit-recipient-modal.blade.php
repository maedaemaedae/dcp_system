
<div id="editRecipientModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-2xl p-6">
        <h2 class="text-xl font-semibold mb-4">Edit Recipient</h2>
        <form id="editRecipientForm" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="edit_package_id" class="block font-medium text-sm text-gray-700">Package</label>
                        <select name="package_id" id="edit_package_id" class="w-full border-gray-300 rounded">
                            @foreach($packages as $package)
                                <option value="{{ $package->id }}">
                                    {{ $package->packageType->package_code }} - {{ $package->description }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="edit_recipient_type" class="block font-medium text-sm text-gray-700">Recipient Type</label>
                        <select name="recipient_type" id="edit_recipient_type" class="w-full border-gray-300 rounded" onchange="toggleEditRecipientOptions(this.value)">
                            <option value="school">School</option>
                            <option value="division">Division</option>
                        </select>
                    </div>

                    <div id="edit_schoolRecipient" class="col-span-1 md:col-span-2">
                        <label for="edit_school_id" class="block font-medium text-sm text-gray-700">Select School</label>
                        <select name="recipient_id" id="edit_school_id" class="w-full border-gray-300 rounded">
                            @foreach($schools as $school)
                                <option value="{{ $school->id }}">{{ $school->school_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div id="edit_divisionRecipient" class="col-span-1 md:col-span-2 hidden">
                        <label for="edit_division_id" class="block font-medium text-sm text-gray-700">Select Division</label>
                        <select name="recipient_id" id="edit_division_id" class="w-full border-gray-300 rounded">
                            @foreach($divisions as $division)
                                <option value="{{ $division->id }}">{{ $division->division_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-span-1 md:col-span-2">
                        <label for="contact_person" class="block font-medium text-sm text-gray-700">Contact Person</label>
                        <input type="text" name="contact_person" id="contact_person" class="w-full border-gray-300 rounded" required>
                    </div>

                    <div class="col-span-1 md:col-span-1">
                        <label for="position" class="block font-medium text-sm text-gray-700">Position</label>
                        <input type="text" name="position" id="position" class="w-full border-gray-300 rounded">
                    </div>

                    <div class="col-span-1 md:col-span-1">
                        <label for="contact_number" class="block font-medium text-sm text-gray-700">Contact Number</label>
                        <input type="text" name="contact_number" id="contact_number" class="w-full border-gray-300 rounded">
                    </div>
            </div>

            <div class="mt-6 flex justify-end space-x-2">
                <button type="button" onclick="closeModal('editRecipientModal')" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Update</button>
            </div>
        </form>
    </div>
</div>

<script>
    function toggleEditRecipientOptions(type) {
        document.getElementById('edit_schoolRecipient').classList.toggle('hidden', type !== 'school');
        document.getElementById('edit_divisionRecipient').classList.toggle('hidden', type !== 'division');
    }

    function openEditModal(id, package_id, recipient_type, recipient_id, notes) {
        document.getElementById('editRecipientForm').action = `/recipients/${id}`;
        document.getElementById('edit_package_id').value = package_id;
        document.getElementById('edit_recipient_type').value = recipient_type;
        document.getElementById('edit_notes').value = notes;

        toggleEditRecipientOptions(recipient_type);
        if (recipient_type === 'school') {
            document.getElementById('edit_school_id').value = recipient_id;
        } else {
            document.getElementById('edit_division_id').value = recipient_id;
        }

        openModal('editRecipientModal');
    }
</script>
