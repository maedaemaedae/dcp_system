<!-- resources/views/regionaloffices/partials/edit-modal.blade.php -->
<div id="editModal-{{ $ro->ro_id }}" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-2xl shadow-2xl p-6 w-full max-w-lg relative">
        <!-- Close Button -->
        <button type="button"
                onclick="closeEditModal({{ $ro->ro_id }})"
                class="absolute top-3 right-4 text-gray-400 hover:text-gray-600 text-2xl transition-colors duration-200">
            &times;
        </button>

        <!-- Modal Title -->
        <h3 class="text-xl font-semibold text-[#033372] mb-6">Edit Regional Office</h3>

        <form action="{{ route('regional-offices.update', $ro->ro_id) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <!-- Office -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Office</label>
                <input type="text" name="ro_office" value="{{ $ro->ro_office }}"
                       class="w-full rounded-md border border-gray-300 px-4 py-2 text-sm focus:ring-[#4A90E2] focus:border-[#4A90E2]"
                       required>
            </div>

            <!-- Person in Charge -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Person in Charge</label>
                <input type="text" name="person_in_charge" value="{{ $ro->person_in_charge }}"
                       class="w-full rounded-md border border-gray-300 px-4 py-2 text-sm focus:ring-[#4A90E2] focus:border-[#4A90E2]"
                       required>
            </div>

            <!-- Email -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" value="{{ $ro->email }}"
                       class="w-full rounded-md border border-gray-300 px-4 py-2 text-sm focus:ring-[#4A90E2] focus:border-[#4A90E2]"
                       required>
            </div>

            <!-- Contact No. -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Contact No.</label>
                <input type="text" name="contact_no" value="{{ $ro->contact_no }}"
                       class="w-full rounded-md border border-gray-300 px-4 py-2 text-sm focus:ring-[#4A90E2] focus:border-[#4A90E2]"
                       required>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end gap-3 pt-4">
                <button type="submit"
                        class="px-6 py-2 rounded-md bg-[#4A90E2] text-white hover:bg-[#3a78c2] font-medium transition-all">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>
