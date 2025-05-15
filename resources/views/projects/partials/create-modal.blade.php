<div id="addProjectModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white p-6 rounded shadow-lg w-full max-w-2xl relative">
        <button id="closeAddProjectModalBtn" class="absolute top-2 right-2 text-gray-500 text-xl hover:text-black">&times;</button>
        <h2 class="text-xl font-semibold mb-4">Create New Project</h2>

        <form method="POST" action="{{ route('projects.store') }}">
            @csrf

            <div class="mb-4">
                <label class="block font-medium">Project Name</label>
                <input name="name" type="text" class="w-full border px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label class="block font-medium">Packages Included</label>
                <select name="package_types[]" class="w-full border px-3 py-2" multiple required>
                    @foreach ($packageTypes as $type)
                        <option value="{{ $type->id }}">
                            {{ $type->package_code }} - {{ $type->description }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block font-medium">Division</label>
                <select id="divisionSelect" name="division_id" class="w-full border px-3 py-2" required>
                    <option value="">Select Division</option>
                    @foreach ($divisions as $division)
                        <option value="{{ $division->division_id }}">{{ $division->division_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block font-medium">Municipality</label>
                <select id="municipalitySelect" name="municipality_id" class="w-full border px-3 py-2" required>
                    <option value="">Select Municipality</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block font-medium">Schools</label>
                <div class="flex items-center mb-2">
                    <input type="checkbox" id="selectAllSchools" class="mr-2">
                    <label for="selectAllSchools" class="text-sm">Select All Schools</label>
                </div>
                <div id="schoolsCheckboxList" class="max-h-40 overflow-y-auto border p-2 rounded bg-gray-50">
                    <!-- Dynamic list of schools will be inserted here -->
                </div>
            </div>

            <div class="mb-4">
                <label class="block font-medium">Target Delivery Date</label>
                <input name="target_delivery_date" type="date" class="w-full border px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label class="block font-medium">Target Arrival Date</label>
                <input name="target_arrival_date" type="date" class="w-full border px-3 py-2" required>
            </div>

            <div class="text-right">
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Save Project</button>
            </div>
        </form>

        <script>
            document.getElementById('divisionSelect').addEventListener('change', function () {
                fetch(`/api/municipalities/${this.value}`)
                    .then(response => response.json())
                    .then(data => {
                        const municipalitySelect = document.getElementById('municipalitySelect');
                        municipalitySelect.innerHTML = '<option value="">Select Municipality</option>';
                        data.forEach(m => {
                            municipalitySelect.innerHTML += `<option value="${m.municipality_id}">${m.municipality_name}</option>`;
                        });
                    });
            });

            document.getElementById('municipalitySelect').addEventListener('change', function () {
                fetch(`/api/schools/${this.value}`)
                    .then(response => response.json())
                    .then(data => {
                        const schoolList = document.getElementById('schoolsCheckboxList');
                        schoolList.innerHTML = '';
                        data.forEach(school => {
                            schoolList.innerHTML += `
                                <div class="flex items-center mb-1">
                                    <input type="checkbox" name="school_ids[]" value="${school.school_id}" class="mr-2 school-checkbox">
                                    <label>${school.school_name}</label>
                                </div>
                            `;
                        });
                    });
            });

            document.getElementById('selectAllSchools').addEventListener('change', function () {
                document.querySelectorAll('.school-checkbox').forEach(cb => cb.checked = this.checked);
            });
        </script>
    </div>
</div>
