@foreach($projects as $project)
<div id="createPackageModal_{{ $project->id }}" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center transition-opacity duration-300">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-2xl p-6 relative animate-fadeInUp">

        <!-- Close Button -->
        <button onclick="closeModal('createPackageModal_{{ $project->id }}')" class="absolute top-4 right-4 text-gray-400 hover:text-gray-700 text-2xl transition-colors duration-200">&times;</button>

        <h2 class="text-xl font-semibold text-gray-800 mb-4">📦 Add Package for {{ $project->name }}</h2>

        <form action="{{ route('packages.store') }}" method="POST">
            @csrf

            <input type="hidden" name="project_id" value="{{ $project->id }}">

            <div class="mb-4">
                <label for="package_type_id" class="block font-medium text-sm text-gray-700">Package Type</label>
                <select name="package_type_id" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
                    @foreach($packageTypes as $type)
                        <option value="{{ $type->id }}">{{ $type->package_code }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="batch" class="block font-medium text-sm text-gray-700">Batch</label>
                <input type="text" name="batch" class="w-full border border-gray-300 rounded-lg px-4 py-2">
            </div>

            <div class="mb-4">
                <label for="lot" class="block font-medium text-sm text-gray-700">Lot</label>
                <input type="text" name="lot" class="w-full border border-gray-300 rounded-lg px-4 py-2">
            </div>

            <div class="mb-4">
                <label for="description" class="block font-medium text-sm text-gray-700">Description</label>
                <textarea name="description" rows="3" class="w-full border border-gray-300 rounded-lg px-4 py-2 resize-none"></textarea>
            </div>

            <div class="mt-6 flex justify-end space-x-2">
                <button type="button" onclick="closeModal('createPackageModal_{{ $project->id }}')" class="bg-gray-200 text-gray-700 px-6 py-2 rounded-lg font-semibold shadow hover:bg-gray-300 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-gray-400">
                    Cancel
                </button>
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold shadow hover:bg-blue-700 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-400">
                    Create
                </button>
            </div>
        </form>
    </div>
</div>
@endforeach
