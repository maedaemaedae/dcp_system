<!-- Create School Modal -->
<div id="createModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
    <div class="bg-white p-6 rounded-2xl w-full max-w-2xl relative animate-fade-in-up">
        
        <button onclick="closeModal('createModal')" class="absolute top-3 right-3 text-gray-400 text-2xl hover:text-[#4A90E2] transition">
      &times;
    </button>

        <h2 class="text-xl text-[#033372] font-semibold mb-4">Add New School</h2>

        <form method="POST" action="{{ route('schools.store') }}" class="space-y-4">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-medium">School ID</label>
                    <input type="text" name="school_id" class="w-full border rounded px-3 py-2" required>
                </div>
                <div>
                    <label class="block font-medium">School Name</label>
                    <input type="text" name="school_name" class="w-full border rounded px-3 py-2" required>
                </div>
                <div>
                    <label class="block font-medium">School Address</label>
                    <input type="text" name="school_address" class="w-full border rounded px-3 py-2" required>
                </div>
                <div>
                    <label class="block font-medium">School Head</label>
                    <input type="text" name="school_head" class="w-full border rounded px-3 py-2" required>
                </div>
                <div>
                    <label class="block font-medium">Level</label>
                    <select name="level" class="w-full border rounded px-3 py-2" required>
                        <option value="">Select Level</option>
                        <option value="Elementary">Elementary</option>
                        <option value="High School">High School</option>
                    </select>
                </div>
                <!-- Division Dropdown -->
                <div>
                    <label class="block font-medium">Division</label>
                    <select name="division_id" class="w-full border rounded px-3 py-2" required>
                        <option value="">Select Division</option>
                        @foreach ($divisions as $division)
                            <option value="{{ $division->division_id }}">{{ $division->division_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block font-medium">Municipality</label>
                    <select name="municipality_id" class="w-full border rounded px-3 py-2" required>
                        <option value="">Select Municipality</option>
                        @foreach ($municipalities as $municipality)
                            <option value="{{ $municipality->municipality_id }}">{{ $municipality->municipality_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="text-right">
                <button type="submit" class="text-white px-4 py-2 rounded-md transition" style="background-color: #4A90E2;" onmouseover="this.style.backgroundColor='#3a78c2'" onmouseout="this.style.backgroundColor='#4A90E2'">
                    Save
                </button>
            </div>
        </form>
    </div>
</div>
