<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <!-- Cropper CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" rel="stylesheet">
    <!-- Cropper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>

</head>

<body class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200 font-[Poppins]">

<!-- Toast Notification -->
<div id="toast"
     x-data="{ show: false, message: '' }"
     x-show="show"
     x-transition
     x-init="$watch('show', val => val && setTimeout(() => show = false, 3000))"
     class="fixed bottom-5 right-5 bg-green-600 text-white px-4 py-2 rounded shadow-lg z-50 text-sm"
     style="display: none;">
    <span x-text="message"></span>
</div>

    @include('layouts.top-navbar')
   

                @php
                    $user = auth()->user();
                    $dashboardRoute = ($user && $user->role_id === 1)
                        ? 'superadmin.dashboard'
                        : 'dashboard';
                @endphp 

    @if ($user && $user->role_id === 1)
        <!-- Back to Home Button -->
        <a href="{{ route('superadmin.dashboard') }}"
           class="fixed top-[6.5rem] left-6 text-[#4A90E2] hover:text-[#357ABD] text-base font-medium flex items-center z-50 transition-all duration-300 ease-in-out transform hover:-translate-x-1 bg-white dark:bg-gray-800 px-4 py-2 rounded-full shadow-md">
            <!-- Left Arrow Icon -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 transition-transform duration-300 group-hover:-translate-x-1" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            Back to Dashboard
        </a>
@endif

@if ($user && $user->role_id === 6)
        <!-- Back to Dashboard Button -->
        <a href="{{ route('supplier.deliveries.index') }}"
           class="fixed top-[6.5rem] left-6 text-[#4A90E2] hover:text-[#357ABD] text-base font-medium flex items-center z-50 transition-all duration-300 ease-in-out transform hover:-translate-x-1 bg-white dark:bg-gray-800 px-4 py-2 rounded-full shadow-md">
            <!-- Left Arrow Icon -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 transition-transform duration-300 group-hover:-translate-x-1" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            Back to My Deliveries
        </a>
   @endif



    <!-- Main Content -->
    <main class="py-12">
        <div class="max-w-5xl mx-auto space-y-8 px-4 sm:px-6 lg:px-8">

<!-- Profile Image Upload Section -->
<div id="profile-photo" class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 mt-[8rem]" x-data="profileCropper()" x-cloak>
    <div class="flex flex-col items-center bg-white dark:bg-gray-800 p-8 rounded-xl shadow-lg">

        <!-- Clickable Profile Image -->
        <div @click="() => {}" class="relative w-48 h-48 rounded-full overflow-hidden border-4 border-blue-300 dark:border-gray-600 shadow mb-6">
            @if ($user->profile_photo_path)
                <img src="{{ asset('storage/' . $user->profile_photo_path) }}"
                    alt="Profile Photo"
                    class="w-full h-full object-cover rounded-full">
            @else
                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}"
                    alt="Default Avatar"
                    class="w-full h-full object-cover rounded-full">
            @endif
        </div>

        <!-- Upload Trigger -->
        <label class="flex items-center gap-3 px-4 py-2 bg-blue-50 dark:bg-gray-700 text-[#4A90E2] dark:text-blue-300 hover:bg-blue-100 dark:hover:bg-gray-600 rounded-lg cursor-pointer transition-colors duration-200 border border-blue-200 dark:border-gray-600">
            <i class="fa-solid fa-upload"></i>
            <span class="text-sm font-medium">Choose New Photo</span>
            <input type="file" accept="image/*" @change="openModal($event.target)" class="hidden">
        </label>
    </div>

    <!-- Cropper Modal -->
    <div x-show="showModal" class="fixed inset-0 z-50 bg-black bg-opacity-60 flex justify-center items-center" x-transition>
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-xl w-full max-w-md">
            <h2 class="text-lg font-semibold mb-4 text-center">Crop Your Photo</h2>
            <div class="w-full aspect-square overflow-hidden mb-4">
                <img id="cropper-image" src="" class="max-h-[300px] mx-auto" />
            </div>
            <div class="flex justify-between">
                <button @click="closeModal" :disabled="loading"
                    class="px-4 py-2 bg-gray-300 dark:bg-gray-700 rounded disabled:opacity-50">
                    Cancel
                </button>

                <button @click="uploadCroppedImage" :disabled="loading"
                    class="px-4 py-2 bg-[#4A90E2] text-white rounded disabled:opacity-60 disabled:cursor-not-allowed">
                    Upload
                </button>
            </div>
            <!-- Loading Message with Spinner -->
            <div x-show="loading" class="flex items-center justify-center text-[#4A90E2] text-sm mb-4 space-x-2">
                <svg class="animate-spin h-5 w-5 text-[#4A90E2]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                </svg>
                <span>Uploading cropped image...</span>
            </div>
            <!-- Loading Spinner Overlay -->
            <div x-show="loading" class="absolute inset-0 bg-white bg-opacity-75 flex items-center justify-center z-50">
                <div class="w-10 h-10 border-4 border-blue-500 border-t-transparent rounded-full animate-spin"></div>
            </div>

        </div>
    </div>
</div>

            <!-- Profile Information -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 sm:p-8">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4 border-b pb-2">Profile Information</h3>
                <div class="mt-4">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Update Password -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 sm:p-8">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4 border-b pb-2">Change Password</h3>
                <div class="mt-4">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Delete Account -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 sm:p-8 border border-red-300 dark:border-red-600">
                <h3 class="text-lg font-semibold text-red-600 dark:text-red-400 mb-4 border-b border-red-300 dark:border-red-600 pb-2">Danger Zone</h3>
                <div class="mt-4">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </main>



<script>
    document.addEventListener('DOMContentLoaded', function () {
        const target = document.getElementById('profile-photo');
        if (target) {
            setTimeout(() => {
                const yOffset = -100; // para hindi matakpan ng navbar
                const y = target.getBoundingClientRect().top + window.pageYOffset + yOffset;
                window.scrollTo({ top: y, behavior: 'smooth' });
            }, 200); // delay to make sure Alpine + layout is ready
        }
    });
</script>


<!-- Alpine.js Cropper Component -->
<script>
    function profileCropper() {
        return {
            showModal: false,
            cropper: null,
            imageFile: null,
            loading: false,

            openModal(input) {
                const file = input.files[0];
                if (!file) return;

                this.imageFile = file;
                const reader = new FileReader();

                reader.onload = (e) => {
                    const image = document.getElementById('cropper-image');
                    image.src = e.target.result;

                    this.showModal = true;

                    this.$nextTick(() => {
                        if (this.cropper) this.cropper.destroy();

                        this.cropper = new Cropper(image, {
                            aspectRatio: 1,
                            viewMode: 1,
                            background: false,
                            autoCropArea: 1,
                        });
                    });
                };

                reader.readAsDataURL(file);
            },

            closeModal() {
                if (this.cropper) {
                    this.cropper.destroy();
                    this.cropper = null;
                }

                this.loading = false;
                this.showModal = false;
            },

            async uploadCroppedImage() {
                if (!this.cropper || this.loading) return;

                this.loading = true;

                const canvas = this.cropper.getCroppedCanvas({
                    width: 300,
                    height: 300,
                });

                const blob = await new Promise(resolve => canvas.toBlob(resolve, 'image/jpeg'));
                const formData = new FormData();
                formData.append('profile_photo', blob, 'cropped.jpg');
                formData.append('_token', '{{ csrf_token() }}');

                const startTime = Date.now();

                fetch("{{ route('profile.photo.upload') }}", {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json'
                    },
                    body: formData,
                })
                .then(res => res.json())
                .then(async data => {
                    const elapsed = Date.now() - startTime;
                    const delay = Math.max(3000 - elapsed, 0);
                    await new Promise(resolve => setTimeout(resolve, delay));

                    if (data.success && data.photo_url) {
                        const timestampedUrl = data.photo_url + '?t=' + new Date().getTime();

                        const profileImage = document.querySelector('#profile-photo img');
                        if (profileImage) profileImage.src = timestampedUrl;

                        document.querySelectorAll('#navbar-profile-photo').forEach(img => {
                            img.src = timestampedUrl;
                        });

                        const toast = document.getElementById('toast');
                        if (toast && toast.__x) {
                            toast.__x.$data.message = data.message || 'Profile photo updated!';
                            toast.__x.$data.show = true;
                        }
                    } else {
                        alert(data.message || 'Upload failed.');
                    }

                    this.closeModal();
                })
                .catch(() => {
                    alert('An error occurred while uploading your photo.');
                    this.loading = false;
                });
            }
        };
    }
</script>


</body>

</html>
