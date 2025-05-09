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

</head>

<body class="bg-gray-100 font-sans">
<div class="flex h-screen relative bg-white">

    <!-- Side Bar -->
    @include('components.sidebar')

    <!-- Top Navbar -->
<header class="w-full h-20 fixed top-0 left-0 bg-white shadow-md flex items-center justify-between px-8 z-10">
    <div class="flex items-center gap-2">
        <img src="{{ asset('images/landscape-logo.png') }}" class="h-20 w-auto ml-[-20px]" alt="Logo">
    </div>

    <div class="relative" x-data="{ open: false }">
        <!-- User Name -->
        <div class="flex items-center gap-4">
            <span class="text-base text-black">{{ Auth::user()->name }}</span>

            <!-- Profile Dropdown Trigger -->
            <button @click="open = !open" class="w-14 h-14 bg-zinc-300 rounded-full flex items-center justify-center hover:ring-2 hover:ring-blue-500 transition focus:outline-none mr-[40px]">
                <!-- Optional icon or profile initials -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 15c2.485 0 4.779.63 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </button>
        </div>

        <!-- Dropdown Menu -->
        <div x-show="open" @click.away="open = false"
             class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-2 z-20 text-sm text-gray-700 "
             x-transition>
            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 hover:bg-gray-100">Profile</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-100">Logout</button>
            </form>
        </div>
    </div>
</header>


      <!-- Main Content -->
    <div :class="open ? 'ml-[300px]' : 'ml-20'" class="transition-all duration-300 pt-24 p-8 relative">
    <h2 class="text-[45px] font-bold text-gray-800 mb-6 border-b border-gray-300 pb-2 tracking-wide">
  📘 School Management
</h2>
        
    
            <!-- Add School Button -->
            <div class="mb-4">
                <button onclick="openCreateModal()" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    + Add School
                </button>
            </div>

            <!-- Search Form -->
            <form method="GET" action="{{ route('schools.index') }}" class="mb-4 flex items-center gap-2">
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Search by ID, Name, or Address..."
                    class="w-full md:w-1/3 border rounded px-3 py-2">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Search
                </button>
            </form>

            <!-- Schools Table -->
            <div class="overflow-x-auto bg-white shadow rounded-lg">
    <table class="min-w-full text-sm text-gray-800">
        <thead class="bg-blue-600 text-white">
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
                <th class="px-4 py-3 text-left">Actions</th>
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
                        <div class="flex items-center gap-2">
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

                            <button
                                data-school='{{ $schoolJson }}'
                                onclick="handleEditClick(this)"
                                class="bg-yellow-400 hover:bg-yellow-500 text-white px-2 py-1 rounded text-xs transition"
                                title="Edit"
                            >
                                ✏️
                            </button>

                            <form action="{{ route('schools.destroy', $school->school_id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button
                                    onclick="return confirm('Are you sure you want to delete this school?')"
                                    class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded text-xs transition"
                                    title="Delete"
                                >
                                    🗑️
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
            document.addEventListener('DOMContentLoaded', function() {
                const toast = document.createElement('div');
                let message = "{{ session('success') }}";

                if (message.includes('Added')) {
                    message = '✔ ' + message;
                } else if (message.includes('Updated')) {
                    message = '\u270F\uFE0F ' + message;
                } else if (message.includes('Removed')) {
                    message = '🗑 ' + message;
                }

                toast.innerText = message;
                toast.className = "fixed bottom-4 left-1/2 transform -translate-x-1/2 bg-green-500 text-white py-4 px-8 rounded-lg shadow-lg z-50 text-center text-lg font-semibold";
                document.body.appendChild(toast);

                setTimeout(() => {
                    toast.remove();
                }, 3000);
            });
        </script>
    @endif
        </body>
     </html>
