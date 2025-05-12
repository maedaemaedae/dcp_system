<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <script src="https://unpkg.com/alpinejs" defer></script>

    <!-- Google Fonts: Poppins -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

</head>

<body class="bg-white font-['Poppins']" x-data="{ open: true }">
  <div class="flex h-screen">

    <div class="w-[1440px] h-[1024px] relative bg-white overflow-hidden">
        
      <!-- Side Bar -->
    @include('components.sidebar')

      <!-- Top Nav Bar -->
    @include('components.top-navbar')



        <!-- Sample Dashboard Content Area -->
            <main :class="open ? 'ml-72' : 'ml-20'" class="transition-all duration-300 top-24 p-8 relative">

            <h2 class="text-[45px] font-bold text-gray-800 dark:text-white mb-6 border-b border-gray-300 dark:border-gray-600 pb-2 tracking-wide">
                📊 Dashboard
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-white dark:bg-gray-800 shadow-lg rounded-2xl p-20 h-52 flex items-center justify-center">
                    <span class="text-gray-700 dark:text-white font-semibold">Card 1</span>
                </div>
                <div class="bg-white dark:bg-gray-800 shadow-lg rounded-2xl p-20 h-52 flex items-center justify-center">
                    <span class="text-gray-700 dark:text-white font-semibold">Card 2</span>
                </div>
                <div class="bg-white dark:bg-gray-800 shadow-lg rounded-2xl p-20 h-52 flex items-center justify-center">
                    <span class="text-gray-700 dark:text-white font-semibold">Card 3</span>
                </div>
            </div>
            </main>
            
    </div>
    
</body>

</html>
