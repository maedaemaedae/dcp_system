<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create an Account</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.bunny.net">

    <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="max-h-screen font-poppins text-gray-900 antialiased bg-gray-100 overflow-y-auto">

    <div class="flex items-center justify-center">
        <div class="w-[799px] h-screen bg-white rounded-xl shadow-lg flex">

           @include('components.back-home')
            
            <!-- Left Image Section -->
            <div class="w-[386px] h-full overflow-hidden rounded-xl">
                <img src="https://placehold.co/400x932?text=400x932" alt="hehe" class="w-full h-full object-cover" />
            </div>

            <!-- Right Form Section -->
            <div class="w-[413px] h-full rounded-lg bg-white px-10 py-6 flex flex-col justify-between overflow-y-auto"> <!-- Adjusted padding and added overflow -->

                <!-- LOGO -->
                <div class="flex justify-center mb-4">
                    <img class="w-16 h-16" src="{{ asset('images/dcp-logo.png') }}" alt="MIMAROPA Logo" />
                </div>

                <div class="text-center text-black text-2xl font-bold font-['Poppins'] mb-6">
                    Create an account
                </div>

                <form method="POST" action="{{ route('register') }}" class="flex flex-col gap-2">
                    @csrf

                    <!-- Username with Icon -->
                    <div>
                        <label class="text-xs font-medium text-gray-600">User  Name</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5.121 17.804A4 4 0 0112 15a4 4 0 016.879 2.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <input type="text"
                                required
                                name="name"
                                class="w-full h-8 pl-9 pr-3 text-xs rounded-md border border-gray-300 focus:ring-1 focus:ring-[#4A90E2] focus:border-[#4A90E2]"
                                placeholder="Enter your user name" />
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="relative">
                        <label for="password" class="text-xs font-medium text-gray-600">Password</label>
                        <div class="relative mt-1">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 11c.552 0 1 .448 1 1v1h-2v-1c0-.552.448-1 1-1zm6 0V9a6 6 0 10-12 0v2H4v10h16V11h-2zm-2 0H8V9a4 4 0 118 0v2z" />
                                </svg>
                            </div>
                            <button type="button"
                                    onclick="togglePasswordVisibility(this)"
                                    data-target="password"
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5 text-gray-400"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="2">
                                    <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 
                                            4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                            <input
                                id="password"
                                name="password"
                                type="password"
                                required
                                class="w-full h-8 pl-9 pr-9 text-xs rounded-md border border-gray-300 focus:ring-1 focus:ring-[#4A90E2] focus:border-[#4A90E2]"
                                placeholder="Create your password"
                            />
                        </div>
                        <!-- Checklist -->
                       <!-- Checklist -->
                        <ul class="text-xs text-gray-600 mt-2 space-y-2" id="passwordChecklist">
                            <li class="flex items-center gap-2">
                                <input type="checkbox" id="lengthCheck" class="accent-[#4A90E2] w-4 h-4 rounded" disabled>
                                <label for="lengthCheck">At least 8 characters</label>
                            </li>
                            <li class="flex items-center gap-2">
                                <input type="checkbox" id="lowercaseCheck" class="accent-[#4A90E2] w-4 h-4 rounded" disabled>
                                <label for="lowercaseCheck">Contains lowercase letter</label>
                            </li>
                            <li class="flex items-center gap-2">
                                <input type="checkbox" id="uppercaseCheck" class="accent-[#4A90E2] w-4 h-4 rounded" disabled>
                                <label for="uppercaseCheck">Contains uppercase letter</label>
                            </li>
                            <li class="flex items-center gap-2">
                                <input type="checkbox" id="numberCheck" class="accent-[#4A90E2] w-4 h-4 rounded" disabled>
                                <label for="numberCheck">Contains a number</label>
                            </li>
                            <li class="flex items-center gap-2">
                                <input type="checkbox" id="symbolCheck" class="accent-[#4A90E2] w-4 h-4 rounded" disabled>
                                <label for="symbolCheck">Contains a symbol (!@#$%)</label>
                            </li>
                        </ul>

                    </div>

                    <div class="relative">
                        <label for="password_confirmation" class="text-xs font-medium text-gray-600">Confirm Password</label>
                        <div class="relative mt-1">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                               <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 11c.552 0 1 .448 1 1v1h-2v-1c0-.552.448-1 1-1zm6 0V9a6 6 0 10-12 0v2H4v10h16V11h-2zm-2 0H8V9a4 4 0 118 0v2z" />
                                </svg>
                            </div>
                            <button type="button"
                                    onclick="togglePasswordVisibility(this)"
                                    data-target="password_confirmation"
                                    class="absolute right-3 top-2 text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="2">
                                    <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 
                                            4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>

                            <input
                                type="password"
                                name="password_confirmation"
                                id="password_confirmation"
                                required
                                class="w-full h-8 pl-9 pr-10 text-xs rounded-md border border-gray-300 focus:ring-1 focus:ring-[#4A90E2] focus:border-[#4A90E2]"
                                placeholder="Confirm your password"
                            />
                        </div>
                        <!-- Error message -->
                        <p id="confirmPasswordError" class="mt-1 text-xs text-red-500 hidden">
                            Password does not match.
                        </p>

                    </div>

<script>
function togglePasswordVisibility(button) {
    const inputId = button.getAttribute('data-target');
    const input = document.getElementById(inputId);
    const svg = button.querySelector('svg');

    if (input.type === 'password') {
        input.type = 'text';
        svg.innerHTML = `
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.038 10.038 0 012.65-4.043m3.6-2.161A9.953 9.953 0 0112 5
                     c4.478 0 8.268 2.943 9.542 7a9.965 9.965 0 01-4.293 5.148M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 3l18 18" />
        `;
    } else {
        input.type = 'password';
        svg.innerHTML = `
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M2.458 12C3.732 7.943 7.523 5 12 5
                     c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7
                     -4.477 0-8.268-2.943-9.542-7z" />
        `;
    }
}
</script>


                    <!-- First Name -->
                    <div>
                        <label class="text-xs font-medium text-gray-600">First Name</label>
                        <input type="text" name="first_name" id="first_name" required class="w-full h-8 px-3 text-xs rounded-md border border-gray-300 focus:ring-1 focus:ring-[#4A90E2] focus:border-[#4A90E2]" placeholder="Enter your first name" />
                    </div>

                    <!-- Last Name -->
                    <div>
                        <label class="text-xs font-medium text-gray-600">Last Name</label>
                        <input type="text" name="last_name" id="last_name" required class="w-full h-8 px-3 text-xs rounded-md border border-gray-300 focus:ring-1 focus:ring-[#4A90E2] focus:border-[#4A90E2]" placeholder="Enter your last name" />
                    </div>

                    <!-- Gender Selection -->
            <div class="w-[350px]">
                <!-- Label -->
                <label class="block text-gray-600 text-sm font-medium font-[Poppins] mb-2">Gender</label>

                <!-- Radio Group -->
                <div class="flex gap-4">
                    <!-- Male -->
                    <label class="w-[140px] h-10 px-4 py-2 bg-white rounded-md outline outline-1 outline-offset-[-1px] 
                                outline-gray-300 inline-flex items-center gap-2 cursor-pointer transition 
                                peer-checked:outline-[#4A90E2] peer-checked:outline-2">
                        <input type="radio" name="gender" value="male" />
                        <div class="w-3.5 h-3.5 relative">                          
                            <div class="w-2 h-2 bg-transparent rounded-full absolute top-[3px] left-[3px] peer-checked:bg-[#4A90E2] transition"></div>
                        </div>
                        <span class="text-gray-800 text-sm font-[Poppins]">Male</span>
                    </label>

                    <!-- Female -->
                    <label class="w-[140px] h-10 px-4 py-2 bg-white rounded-md outline outline-1 outline-offset-[-1px] 
                                outline-gray-300 inline-flex items-center gap-2 cursor-pointer transition 
                                peer-checked:outline-[#4A90E2] peer-checked:outline-2">
                        <input type="radio" name="gender" value="female" />
                        <div class="w-3.5 h-3.5 relative">
                            <div class="w-2 h-2 bg-transparent rounded-full absolute top-[3px] left-[3px] peer-checked:bg-[#4A90E2] transition"></div>
                        </div>
                        <span class="text-gray-800 text-sm font-[Poppins]">Female</span>
                    </label>
                </div>
            </div>


                    <!-- Email -->
                    <div>
                        <label class="text-xs font-medium text-gray-600">Email Address</label>
                        <input type="email" name="email" id="email" required
                            class="w-full h-8 px-3 text-xs rounded-md border border-gray-300 focus:ring-1 focus:ring-[#4A90E2] focus:border-[#4A90E2]"
                            placeholder="Enter your email address" value="{{ old('email') }}" />
                        <p id="email-error" class="text-red-500 text-xs mt-1 hidden">Email already exists.</p>
                    </div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const emailInput = document.getElementById('email');
    const errorMessage = document.getElementById('email-error');

    let timer;
    emailInput.addEventListener('input', function () {
        clearTimeout(timer);
        timer = setTimeout(() => {
            const email = emailInput.value;

            if (!email) {
                errorMessage.classList.add('hidden');
                return;
            }

            fetch("{{ route('check.email-register') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": '{{ csrf_token() }}'
                },
                body: JSON.stringify({ email })
            })
            .then(response => response.json())
            .then(data => {
                if (data.exists) {
                    errorMessage.classList.remove('hidden');
                } else {
                    errorMessage.classList.add('hidden');
                }
            });
        }, 500); // debounce 0.5s
    });
});
</script>


<script>
document.addEventListener('DOMContentLoaded', function () {
    const emailInput = document.getElementById('email');
    const errorMessage = document.getElementById('email-error');

    let timer;
    emailInput.addEventListener('input', function () {
        clearTimeout(timer);
        timer = setTimeout(() => {
            const email = emailInput.value;

            if (!email) {
                errorMessage.classList.add('hidden');
                return;
            }

            fetch("{{ route('check.email-register') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": '{{ csrf_token() }}'
                },
                body: JSON.stringify({ email })
            })
            .then(response => response.json())
            .then(data => {
                if (data.exists) {
                    errorMessage.classList.remove('hidden');
                } else {
                    errorMessage.classList.add('hidden');
                }
            });
        }, 500); // debounce 0.5s
    });
});
</script>


                    <!-- Contact Number -->
                    <div id="contact-container">
                        <label class="text-xs font-medium text-gray-600">Contact Number</label>
                        <input type="text" name="contact_number" id="contact_number" required
                            class="w-full h-8 px-3 text-xs rounded-md border border-gray-300 focus:ring-1 focus:ring-[#4A90E2] focus:border-[#4A90E2] peer"
                            placeholder="Enter your contact number" />

                        <!-- Error message (invalid format) -->
                        <p id="invalid-msg" class="mt-1 text-[11px] text-red-500 hidden">
                            Please enter a valid contact number.
                        </p>

                        <!-- Error message (duplicate) -->
                        <p id="duplicate-msg" class="mt-1 text-[11px] text-red-500 hidden">
                            This contact number already exists.
                        </p>
                    </div>

    <script>
    // For Fields Validation
    const existingNumbers = ['09123456789', '09987654321'];

    const input = document.getElementById('contact_number');
    const invalidMsg = document.getElementById('invalid-msg');
    const duplicateMsg = document.getElementById('duplicate-msg');
    const passwordInput = document.getElementById('password');
    const passwordError = document.getElementById('passwordError');
    const lengthCheck = document.getElementById('lengthCheck');
    const lowercaseCheck = document.getElementById('lowercaseCheck');
    const uppercaseCheck = document.getElementById('uppercaseCheck');
    const numberCheck = document.getElementById('numberCheck');
    const symbolCheck = document.getElementById('symbolCheck');
                        
    passwordInput.addEventListener('input', () => {
        const val = passwordInput.value;

        // Length check
        if (val.length >= 8) {
            updateChecklist(lengthCheck, true);
        } else {
            updateChecklist(lengthCheck, false);
        }

        // Lowercase
        updateChecklist(lowercaseCheck, /[a-z]/.test(val));

        // Uppercase
        updateChecklist(uppercaseCheck, /[A-Z]/.test(val));

        // Number
        updateChecklist(numberCheck, /\d/.test(val));

        // Symbol
        updateChecklist(symbolCheck, /[!@#$%^&*(),.?":{}|<>]/.test(val));
    });

    function updateChecklist(element, isValid) {
        element.children[0].textContent = isValid ? '🟢' : '🔴';
    }

    // Contact Number Validation
    input.addEventListener('blur', function () {
        const number = input.value.trim();

        // Basic validation (11 digits, numeric)
        const isValid = /^09\d{9}$/.test(number); // Example: PH number format

        // Reset messages
        invalidMsg.classList.add('hidden');
        duplicateMsg.classList.add('hidden');
        input.classList.remove('border-red-500');

        if (!isValid) {
            invalidMsg.classList.remove('hidden');
            input.classList.add('border-red-500');
        } else if (existingNumbers.includes(number)) {
            duplicateMsg.classList.remove('hidden');
            input.classList.add('border-red-500');
        }
    });
</script>

<script>
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('password_confirmation');
    const confirmPasswordError = document.getElementById('confirmPasswordError');

    // Show/hide error while typing
    confirmPassword.addEventListener('input', function () {
        if (confirmPassword.value !== password.value) {
            confirmPasswordError.classList.remove('hidden');
        } else {
            confirmPasswordError.classList.add('hidden');
        }
    });

    // Optional: prevent form submission if passwords don’t match
    document.querySelector('form').addEventListener('submit', function (e) {
        if (password.value !== confirmPassword.value) {
            e.preventDefault();
            confirmPasswordError.classList.remove('hidden');
            confirmPassword.focus();
        }
    });
</script>


                    <button type="submit" id="submit-btn" class="mt-4 w-full h-10 border-2 border-[#4A90E2] text-[#4A90E2] text-base font-medium rounded-full hover:bg-[#4A90E2] hover:text-white transition disabled:bg-gray-400 disabled:cursor-not-allowed">
                        Create an account
                    </button>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const emailInput = document.getElementById('email');
    const errorMessage = document.getElementById('email-error');
    const submitBtn = document.getElementById('submit-btn');

    let timer;
    emailInput.addEventListener('input', function () {
        clearTimeout(timer);
        timer = setTimeout(() => {
            const email = emailInput.value;

            if (!email) {
                errorMessage.classList.add('hidden');
                submitBtn.disabled = false;
                return;
            }

            fetch("{{ route('check.email-register') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": '{{ csrf_token() }}'
                },
                body: JSON.stringify({ email })
            })
            .then(response => response.json())
            .then(data => {
                if (data.exists) {
                    errorMessage.classList.remove('hidden');
                    submitBtn.disabled = true;
                } else {
                    errorMessage.classList.add('hidden');
                    submitBtn.disabled = false;
                }
            });
        }, 500); // debounce
    });

    //new
     const passwordInput = document.getElementById('password');
    const lengthCheck = document.getElementById('lengthCheck');
    const lowercaseCheck = document.getElementById('lowercaseCheck');
    const uppercaseCheck = document.getElementById('uppercaseCheck');
    const numberCheck = document.getElementById('numberCheck');
    const symbolCheck = document.getElementById('symbolCheck');

    passwordInput.addEventListener('input', () => {
        const value = passwordInput.value;

        lengthCheck.checked = value.length >= 8;
        lowercaseCheck.checked = /[a-z]/.test(value);
        uppercaseCheck.checked = /[A-Z]/.test(value);
        numberCheck.checked = /\d/.test(value);
        symbolCheck.checked = /[!@#$%^&*]/.test(value);
    });

    // Prevent zoom with Ctrl + Mouse Wheel and Ctrl + +/- on desktop
            document.addEventListener('wheel', function(e) {
                if (e.ctrlKey) {
                    e.preventDefault();
                }
            }, { passive: false });

            document.addEventListener('keydown', function(e) {
                // Prevent Ctrl + '+', Ctrl + '-', Ctrl + '0'
                if (e.ctrlKey && (e.key === '+' || e.key === '-' || e.key === '=' || e.key === '0')) {
                    e.preventDefault();
                }
            });
});
</script>


                    <div class="text-center text-xs mt-2">
                        Already have an account? <a href="{{ route('login') }}" class="text-[#4A90E2] hover:text-[#357ABD] underline font-bold transition">Login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
