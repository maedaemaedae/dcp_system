
<div id="createPackageModal_{{ $project->id }}" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-xl p-6">
        <h2 class="text-xl font-semibold mb-4">Add Package for {{ $project->name }}</h2>
        <form action="{{ route('packages.store') }}" method="POST">
            @csrf

            <input type="hidden" name="project_id" value="{{ $project->id }}">

            <div class="space-y-4">
                <div>
                    <label for="package_type_id" class="block font-medium text-sm text-gray-700">Package Type</label>
                    <select name="package_type_id" class="w-full border-gray-300 rounded" required>
                        @foreach($packageTypes as $type)
                            <option value="{{ $type->id }}">{{ $type->package_code }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="batch" class="block font-medium text-sm text-gray-700">Batch</label>
                    <input type="text" name="batch" class="w-full border-gray-300 rounded">
                </div>

                <div>
                    <label for="lot" class="block font-medium text-sm text-gray-700">Lot</label>
                    <input type="text" name="lot" class="w-full border-gray-300 rounded">
                </div>

                <div>
                    <label for="description" class="block font-medium text-sm text-gray-700">Description</label>
                    <textarea name="description" rows="3" class="w-full border-gray-300 rounded"></textarea>
                </div>
            </div>

            <div class="mt-6 flex justify-end space-x-2">
                <button type="button" onclick="closeModal('createPackageModal_{{ $project->id }}')" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Create</button>
            </div>
        </form>
    </div>
</div>
