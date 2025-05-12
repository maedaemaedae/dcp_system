<x-app-layout>
    <div class="py-12">
       <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Back to Dashboard Button -->
            <div class="flex justify-between items-center">
                <a href="{{ route('dashboard') }}" class="bg-[#1976D2] hover:bg-[#1565C0] text-white px-4 py-2 rounded-md flex items-center space-x-2">
                    <!-- Back Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 12H5M12 5l-7 7 7 7" />
                    </svg>
                    <span>Back to Dashboard</span>
                </a>
            </div>

            <!-- Update Profile Information Form -->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Update Password Form -->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Delete User Form -->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
