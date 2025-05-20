<div id="editProjectModal-{{ $project->id }}" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
   <div class="relative bg-white w-full max-w-3xl p-6 rounded-xl shadow-lg animate-fade-in-up">

    <button 
        type="button" 
        class="absolute top-3 right-3 text-gray-400 text-2xl hover:text-[#4A90E2] transition" 
        onclick="document.getElementById('editProjectModal-{{ $project->id }}').classList.add('hidden')">
        &times;
    </button>

        <h2 class="text-xl font-semibold mb-4">Edit Project - {{ $project->name }}</h2>
        <form action="{{ route('projects.update', $project->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Project Name</label>
                <input 
                type="text" 
                name="name" 
                value="{{ $project->name }}" 
                class="w-full border border-gray-300 rounded-lg px-4 py-2 text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#4A90E2] focus:border-[#4A90E2]" 
                required>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                <select 
                name="status" 
                class="w-full border border-gray-300 rounded-lg px-4 py-2 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#4A90E2] focus:border-[#4A90E2]" 
                required>
                @foreach (['Pending', 'In Progress', 'Delivered', 'Cancelled'] as $statusOption)
                    <option value="{{ $statusOption }}" {{ $project->status === $statusOption ? 'selected' : '' }}>
                    {{ $statusOption }}
                    </option>
                @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Target Delivery Date</label>
                <input 
                type="date" 
                name="target_delivery_date" 
                value="{{ $project->target_delivery_date }}" 
                class="w-full border border-gray-300 rounded-lg px-4 py-2 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#4A90E2] focus:border-[#4A90E2]" 
                required>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Target Arrival Date</label>
                <input 
                type="date" 
                name="target_arrival_date" 
                value="{{ $project->target_arrival_date }}" 
                class="w-full border border-gray-300 rounded-lg px-4 py-2 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#4A90E2] focus:border-[#4A90E2]" 
                required>
            </div>
            </div>

            <div class="mt-6">
            <label class="block text-sm font-semibold text-gray-700 mb-2">Package Types</label>
            <select 
                name="package_types[]" 
                multiple 
                class="w-full border border-gray-300 rounded-lg px-4 py-2 text-gray-800 h-32 focus:outline-none focus:ring-2 focus:ring-[#4A90E2] focus:border-[#4A90E2]">
                @foreach ($packageTypes as $type)
                <option value="{{ $type->id }}" @if ($project->packages->pluck('package_type_id')->contains($type->id)) selected @endif>
                    {{ $type->package_code }}
                </option>
                @endforeach
            </select>
            </div>

            <div class="mt-6">
            <label class="block text-sm font-semibold text-gray-700 mb-2">Assign Schools</label>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 max-h-44 overflow-y-auto border border-gray-300 rounded-lg p-3">
                @php
                $assignedSchoolIds = $project->schools->pluck('school_id')->toArray();
                @endphp
                @foreach (\App\Models\School::all() as $school)
                <label class="inline-flex items-center text-sm text-gray-700">
                    <input type="checkbox" name="school_ids[]" value="{{ $school->school_id }}" 
                        class="form-checkbox text-[#4A90E2] focus:ring-[#4A90E2]" 
                        {{ in_array($school->school_id, $assignedSchoolIds) ? 'checked' : '' }}>
                    <span class="ml-2">{{ $school->school_name }}</span>
                </label>
                @endforeach
            </div>
            </div>

            <div class="mt-8 flex justify-end gap-3">
            <button type="button" id="closeEditProjectModalBtn-{{ $project->id }}" data-project-id="{{ $project->id }}" 
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold px-5 py-2 rounded-lg transition">
                Cancel
            </button>
            <button type="submit" 
                    class="bg-[#4A90E2] hover:bg-[#3a78c2] text-white font-semibold px-6 py-2 rounded-lg transition">
                Save Changes
            </button>
            </div>

        </form>
    </div>
</div>
