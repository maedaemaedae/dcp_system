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

         
            @include('layouts.sidebar') 
       

        <div class="fixed top-0 left-[300px] right-0 bg-white shadow-md h-20 z-10 transition-all duration-300" :class="open ? 'left-[300px]' : 'left-20'">
            @include('layouts.top-navbar') 
            <div class="flex items-center justify-between h-full px-8">
                
        </div>

        <main  :class="open ? 'ml-[5px]' : 'ml-5'" class="transition-all duration-300 pt-24 p-8 relative flex-1 overflow-y-auto h-screen"
>
    <div class="max-w-6xl mx-auto">
        <h2 class="text-[42px] font-bold text-gray-800 dark:text-white mb-6 border-b border-gray-300 dark:border-gray-600 pb-2 tracking-wide">
            👥 Dashboard
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
