<div id="editProjectModal-{{ $project->id }}" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white w-full max-w-3xl p-6 rounded shadow-lg">
        <h2 class="text-xl font-semibold mb-4">Edit Project - {{ $project->name }}</h2>
        <form action="{{ route('projects.update', $project->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium">Project Name</label>
                    <input type="text" name="name" value="{{ $project->name }}" class="w-full border px-3 py-2 rounded" required>
                </div>
                <div>
                    <label class="block text-sm font-medium">Status</label>
                    <select name="status" class="w-full border px-3 py-2 rounded" required>
                        @foreach (['Pending', 'In Progress', 'Delivered', 'Cancelled'] as $statusOption)
                            <option value="{{ $statusOption }}" {{ $project->status === $statusOption ? 'selected' : '' }}>
                                {{ $statusOption }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium">Target Delivery Date</label>
                    <input type="date" name="target_delivery_date" value="{{ $project->target_delivery_date }}" class="w-full border px-3 py-2 rounded" required>
                </div>
                <div>
                    <label class="block text-sm font-medium">Target Arrival Date</label>
                    <input type="date" name="target_arrival_date" value="{{ $project->target_arrival_date }}" class="w-full border px-3 py-2 rounded" required>
                </div>
            </div>

            <div class="mt-4">
                <label class="block text-sm font-medium mb-1">Package Types</label>
                <select name="package_types[]" multiple class="w-full border px-3 py-2 rounded">
                    @foreach ($packageTypes as $type)
                        <option value="{{ $type->id }}"
                            @if ($project->packages->pluck('package_type_id')->contains($type->id)) selected @endif>
                            {{ $type->package_code }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mt-4">
                <label class="block text-sm font-medium mb-1">Assign Schools</label>
                <div class="grid grid-cols-2 gap-2 max-h-40 overflow-y-auto border p-2 rounded">
                    @php
                        $assignedSchoolIds = $project->schools->pluck('school_id')->toArray();
                    @endphp
                    @foreach (\App\Models\School::all() as $school)
                        <label class="text-sm">
                            <input type="checkbox" name="school_ids[]" value="{{ $school->school_id }}"
                                {{ in_array($school->school_id, $assignedSchoolIds) ? 'checked' : '' }}>
                            {{ $school->school_name }}
                        </label>
                    @endforeach
                </div>
            </div>

            @if ($project->schools->isNotEmpty())
                <div class="mt-4">
                    <label class="block text-sm font-medium mb-1">Delivery Status per School</label>
                    <div class="grid grid-cols-2 gap-4">
                        @foreach ($project->schools as $school)
                            <div>
                                <label class="text-sm font-medium block">{{ $school->school_name }}</label>
                               <select name="delivery_statuses[{{ $school->school_id }}]" class="w-full border px-3 py-2 rounded">
                                    @foreach (['Pending', 'Delivered', 'Delayed'] as $statusOption)
                                        <option value="{{ $statusOption }}" {{ $school->pivot->delivery_status === $statusOption ? 'selected' : '' }}>
                                            {{ $statusOption }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="mt-6 flex justify-end gap-2">
                <button type="button" id="closeEditProjectModalBtn-{{ $project->id }}" data-project-id="{{ $project->id }}" class="bg-gray-300 px-4 py-2 rounded">Cancel</button>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Save Changes</button>
            </div>
        </form>
    </div>
</div>
