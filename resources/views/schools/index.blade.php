<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <script src="https://unpkg.com/alpinejs" defer></script>

    <!-- Google Fonts: Poppins -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
@keyframes fade-in-up {
    0% { opacity: 0; transform: translateY(20px); }
    100% { opacity: 1; transform: translateY(0); }
}
@keyframes fade-out-down {
    0% { opacity: 1; transform: translateY(0); }
    100% { opacity: 0; transform: translateY(20px); }
}
.animate-fade-in-up {
    animation: fade-in-up 0.4s ease-out forwards;
}
.animate-fade-out-down {
    animation: fade-out-down 0.4s ease-in forwards;
}
</style>

<script>
        function openCreateModal() {
            document.getElementById('createModal').classList.remove('hidden');
        }

        function handleEditClick(button) {
            const school = JSON.parse(button.getAttribute('data-school'));
            openEditModal(school);
        }

        function openEditModal(school) {
            document.getElementById('editModal').classList.remove('hidden');
            const form = document.getElementById('editSchoolForm');
            form.action = `/schools/${school.school_id}`;

            document.getElementById('edit_school_id').value = school.school_id ?? '';
            document.getElementById('edit_school_name').value = school.school_name ?? '';
            document.getElementById('edit_school_address').value = school.school_address ?? '';
            document.getElementById('edit_school_head').value = school.school_head ?? '';
            document.getElementById('edit_level').value = school.level ?? '';
            document.getElementById('edit_division_id').value = school.division?.division_id ?? '';
            document.getElementById('edit_municipality_id').value = school.municipality?.municipality_id ?? '';
        }

        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
        }
    </script>
    
 @if (session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let message = @json(session('success')).trim();

        const toast = document.createElement('div');

        // Defaults
        let icon = '✅';
        let bgColor = 'bg-green-500';

        // Match by keyword (case-insensitive)
        if (/added/i.test(message)) {
            icon = '✅';
            bgColor = 'bg-green-500';
        } else if (/updated/i.test(message)) {
            icon = '✏️';
            bgColor = 'bg-blue-500';
        } else if (/removed|deleted/i.test(message)) {
            icon = '🗑️';
            bgColor = 'bg-red-500';
        }

        // Toast content
        toast.innerHTML = `
            <div class="flex items-center justify-between space-x-4">
                <div class="flex items-center space-x-3">
                    <span class="text-xl">${icon}</span>
                    <span>${message}</span>
                </div>
                <button onclick="this.parentElement.parentElement.remove()" class="text-white text-xl hover:text-gray-200 transition">&times;</button>
            </div>
        `;

        toast.className = `
            fixed bottom-6 left-1/2 transform -translate-x-1/2
            ${bgColor} text-white px-6 py-3 rounded-xl shadow-lg
            text-sm font-medium z-50 min-w-[300px] max-w-md
            animate-fade-in-up
        `;

        document.body.appendChild(toast);

        // Auto-remove after 4s
        setTimeout(() => {
            toast.classList.remove("animate-fade-in-up");
            toast.classList.add("animate-fade-out-down");
            setTimeout(() => toast.remove(), 400);
        }, 4000);
    });
</script>
@endif


</head>

<body class="bg-gray-100 font-sans">
<div class="flex h-screen relative bg-white">

    <!-- Side Bar -->
    @include('components.sidebar')

    <!-- Top Nav Bar -->
    @include('components.top-navbar')


      <!-- Main Content -->
    <div :class="open ? 'ml-[300px]' : 'ml-20'" class="transition-all duration-300 pt-24 p-8 relative">
    <h2 class="text-[45px] font-bold text-gray-800 mb-6 border-b border-gray-300 pb-2 tracking-wide">
  📘 School Management
</h2>
        
    
          <!-- Add Button -->
            <button onclick="openCreateModal()" 
           class="bg-[#4A90E2] hover:bg-[#357ABD] text-white font-medium px-6 py-2.5 rounded-full shadow-md hover:shadow-lg transition-all duration-300 ease-in-out mb-4 flex items-center space-x-2">
                <i class="fas fa-plus"></i>
                <span>Add School</span>
            </button>


            <!-- Search Form -->
            <form method="GET" action="{{ route('schools.index') }}" class="mb-4">
                <div class="flex items-center space-x-2">
                    <div class="relative w-1/3">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name, email, or role"
                            class="w-full px-4 py-2 border border-gray-300 rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 placeholder-gray-400 pl-10">
                            
                        <!-- Search Icon -->
                        <i class="fa fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-500"></i>
                    </div>
                    <button type="submit" class="bg-[#4A90E2] hover:bg-[#357ABD] text-white px-6 py-2 rounded-full transition-colors duration-200">
                        Search
                    </button>
                </div>
            </form>

            <!-- Schools Table -->
            <div class="overflow-x-auto bg-white rounded-2xl shadow">
                <table class="min-w-full text-sm text-gray-800">
                    <thead class="bg-[#4A90E2] text-white">
            <tr>
                <th class="px-4 py-3 text-left">School ID</th>
                <th class="px-4 py-3 text-left">Name</th>
                <th class="px-4 py-3 text-left">Address</th>
                <th class="px-4 py-3 text-left">School Head</th>
                <th class="px-4 py-3 text-left">Level</th>
                <th class="px-4 py-3 text-left">Division</th>
                <th class="px-4 py-3 text-left">Municipality</th>
                <th class="px-4 py-3 text-left">Created By</th>
                <th class="px-4 py-3 text-left">Created Date</th>
                <th class="px-4 py-3 text-center">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100 bg-white">
            @forelse ($schools as $school)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-4 py-2 whitespace-nowrap">{{ $school->school_id }}</td>
                    <td class="px-4 py-2">{{ $school->school_name }}</td>
                    <td class="px-4 py-2">{{ $school->school_address }}</td>
                    <td class="px-4 py-2">{{ $school->school_head }}</td>
                    <td class="px-4 py-2">
                        <span class="inline-block px-2 py-0.5 rounded-full text-xs font-semibold
                            {{ $school->level === 'Elementary' ? 'bg-blue-100 text-blue-700' :
                               ($school->level === 'Secondary' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700') }}">
                            {{ $school->level }}
                        </span>
                    </td>
                    <td class="px-4 py-2">{{ $school->division->division_name ?? '—' }}</td>
                    <td class="px-4 py-2">{{ $school->municipality->municipality_name ?? '—' }}</td>
                    <td class="px-4 py-2">{{ $school->created_by }}</td>
                    <td class="px-4 py-2">{{ $school->created_date }}</td>
                    <td class="px-4 py-2">
                        <div class="flex items-center space-x-2">
                            @php
                                $schoolJson = json_encode([
                                    "school_id" => $school->school_id,
                                    "school_name" => $school->school_name,
                                    "school_address" => $school->school_address,
                                    "school_head" => $school->school_head,
                                    "level" => $school->level,
                                    "division" => [
                                        "division_id" => $school->division->division_id ?? null
                                    ],
                                    "municipality" => [
                                        "municipality_id" => $school->municipality->municipality_id ?? null
                                    ]
                                ]);
                            @endphp

                            <!-- Edit Button (Primary) -->
                           <button
                            data-school='{{ $schoolJson }}'
                            onclick="handleEditClick(this)"
                            class="px-4 py-1.5 rounded-full bg-[#4A90E2] text-white hover:bg-[#357ABD] transition shadow-sm text-sm font-medium"
                            title="Edit"
                        >
                            Edit
                        </button>



                            <!-- Delete Button (Secondary/Danger) -->
                            <form action="{{ route('schools.destroy', $school->school_id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button
                                    onclick="return confirm('Are you sure you want to delete this school?')"
                                    class="px-4 py-1.5 rounded-full border border-red-500 text-red-500 hover:bg-red-500 hover:text-white transition text-sm font-medium shadow-sm"
                                    title="Delete"
                                >
                                    Delete
                                </button>
                            </form>

                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" class="text-center text-gray-500 py-6">
                        No schools found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
                            

    </div>
</div>

    <!-- Include Create Modal -->
    @include('schools.partials.create-modal')

    <!-- Include Edit Modal -->
    @include('schools.partials.edit-modal')

        </body>
     </html>
