<div id="editModal-{{ $ro->ro_id }}" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white p-6 rounded shadow-lg w-full max-w-2xl relative">
        <button onclick="closeEditModal({{ $ro->ro_id }})" class="absolute top-2 right-2 text-gray-500 text-xl hover:text-black">&times;</button>

        <h2 class="text-xl font-semibold mb-4">Edit Regional Office</h2>

        <form method="POST" action="{{ route('regional-offices.update', $ro->ro_id) }}">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-medium">Office Name</label>
                    <input type="text" name="ro_office" value="{{ $ro->ro_office }}" class="w-full border rounded px-3 py-2" required>
                </div>
                <div>
                    <label class="block font-medium">Person in Charge</label>
                    <input type="text" name="person_in_charge" value="{{ $ro->person_in_charge }}" class="w-full border rounded px-3 py-2" required>
                </div>
                <div>
                    <label class="block font-medium">Email</label>
                    <input type="email" name="email" value="{{ $ro->email }}" class="w-full border rounded px-3 py-2">
                </div>
                <div>
                    <label class="block font-medium">Contact No.</label>
                    <input type="text" name="contact_no" value="{{ $ro->contact_no }}" class="w-full border rounded px-3 py-2">
                </div>
            </div>

            <div class="mt-6 text-right">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
            </div>
        </form>
    </div>
</div>
