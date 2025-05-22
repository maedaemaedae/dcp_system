
<div id="addProjectModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50 min-h-screen px-4">
  <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-[1150px] h-[600px] relative overflow-y-auto animate-fade-in-up">
    <!-- modal content -->
     
    <button id="closeAddProjectModalBtn" class="absolute top-3 right-3 text-gray-400 text-2xl hover:text-[#4A90E2] transition">
      &times;
    </button>
    
    <h2 class="text-2xl font-semibold mb-6 text-[#4A90E2]">Create New Project</h2>

    <form method="POST" action="{{ route('projects.store') }}">
      @csrf

      <div class="mb-5">
        <label class="block font-semibold mb-1 text-gray-700">Project Name</label>
        <input
          name="name"
          type="text"
          class="w-full border border-gray-300 rounded-md px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#4A90E2] focus:border-transparent"
          required
        />
      </div>

      <div class="mb-5">
        <label class="block font-semibold mb-1 text-gray-700">Packages Included</label>
        <select
          name="package_types[]"
          multiple
          class="w-full border border-gray-300 rounded-md px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#4A90E2] focus:border-transparent"
          required
        >
          @foreach ($packageTypes as $type)
          <option value="{{ $type->id }}">{{ $type->package_code }} - {{ $type->description }}</option>
          @endforeach
        </select>
      </div>

      <div class="mb-5">
        <label class="block font-semibold mb-1 text-gray-700">Division</label>
        <select
          id="divisionSelect"
          name="division_id"
          class="w-full border border-gray-300 rounded-md px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#4A90E2] focus:border-transparent"
          required
        >
          <option value="">Select Division</option>
          @foreach ($divisions as $division)
          <option value="{{ $division->division_id }}">{{ $division->division_name }}</option>
          @endforeach
        </select>
      </div>

      <div class="mb-5">
        <label class="block font-semibold mb-1 text-gray-700">Municipality</label>
        <select
          id="municipalitySelect"
          name="municipality_id"
          class="w-full border border-gray-300 rounded-md px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#4A90E2] focus:border-transparent"
          required
        >
          <option value="">Select Municipality</option>
        </select>
      </div>

      <div class="mb-5">
        <label class="block font-semibold mb-2 text-gray-700">Schools</label>
        <div class="flex items-center mb-3">
          <input type="checkbox" id="selectAllSchools" class="mr-2 rounded border-gray-300 text-[#4A90E2] focus:ring-[#4A90E2]" />
          <label for="selectAllSchools" class="text-sm text-gray-600 cursor-pointer">Select All Schools</label>
        </div>
        <div
          id="schoolsCheckboxList"
          class="max-h-40 overflow-y-auto border border-gray-300 rounded-md p-3 bg-gray-50"
        >
          <!-- Dynamic list of schools will be inserted here -->
        </div>
      </div>

      <div class="mb-5">
        <label class="block font-semibold mb-1 text-gray-700">Target Delivery Date</label>
        <input
          name="target_delivery_date"
          type="date"
          class="w-full border border-gray-300 rounded-md px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#4A90E2] focus:border-transparent"
          required
        />
      </div>

      <div class="mb-6">
        <label class="block font-semibold mb-1 text-gray-700">Target Arrival Date</label>
        <input
          name="target_arrival_date"
          type="date"
          class="w-full border border-gray-300 rounded-md px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#4A90E2] focus:border-transparent"
          required
        />
      </div>

       <div class="text-right flex justify-end gap-3">
        <button
          type="button"
          id="cancelAddProjectBtn"
          class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold px-6 py-3 rounded-md transition"
        >
          Cancel
        </button>

      <div class="text-right">
        <button
          type="submit"
          class="bg-[#4A90E2] hover:bg-[#3a78cc] text-white font-semibold px-6 py-3 rounded-md transition"
        >
          Save Project
        </button>
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
                  <input type="checkbox" name="school_ids[]" value="${school.school_id}" class="mr-2 school-checkbox rounded border-gray-300 text-[#4A90E2] focus:ring-[#4A90E2]">
                  <label>${school.school_name}</label>
                </div>
              `;
            });
          });
      });

      document.getElementById('selectAllSchools').addEventListener('change', function () {
        document.querySelectorAll('.school-checkbox').forEach(cb => cb.checked = this.checked);
      });

      // Close modal on cancel button click
      document.getElementById('cancelAddProjectBtn').addEventListener('click', function() {
        document.getElementById('addProjectModal').classList.add('hidden');
      });

      // Close modal on close button click (×)
      document.getElementById('closeAddProjectModalBtn').addEventListener('click', function() {
        document.getElementById('addProjectModal').classList.add('hidden');
      });
    </script>
  </div>
</div>
