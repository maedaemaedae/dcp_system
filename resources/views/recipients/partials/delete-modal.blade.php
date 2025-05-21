<!-- Delete Modal -->
<div id="deleteModal_{{ $school->school_id }}" class="fixed inset-0 flex items-center justify-center z-50 hidden bg-black bg-opacity-50">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Delete School</h2>
        <p class="mb-4 text-sm text-gray-600">
            Are you sure you want to delete <strong>{{ $school->school_name }}</strong> (ID: {{ $school->school_id }})? This action cannot be undone.
        </p>

        <div class="flex justify-end gap-3">
            <button onclick="document.getElementById('deleteModal_{{ $school->school_id }}').classList.add('hidden')" class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400">Cancel</button>

            <form method="POST" action="{{ route('schools.destroy', $school->school_id) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Delete</button>
            </form>
        </div>
    </div>
</div>
