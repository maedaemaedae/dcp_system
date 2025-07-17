<footer class="bg-white dark:bg-gray-900 border-t border-gray-200 dark:border-gray-700 mt-20 py-8">
    <div class="max-w-7xl mx-auto px-6 flex flex-col sm:flex-row justify-between items-center gap-6 text-sm text-gray-600 dark:text-gray-400">
        
        <!-- Branding / Copyright with Logo -->
        <div class="flex items-center text-center sm:text-left gap-3">
            <img src="{{ asset('images/dcp-logo.png') }}" alt="DepEd MIMAROPA Logo" class="w-10 h-10">
            <div>
                <p class="text-gray-800 dark:text-gray-200 font-medium">
                    © {{ date('Y') }} Department of Education - MIMAROPA Region
                </p>
                <p class="text-xs text-gray-500 dark:text-gray-500 mt-1">
                    System developed by 
                    <a href="https://github.com/PaulAmegleo" target="_blank" class="font-semibold text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition">
                        John Paul Amegleo
                    </a>, 
                    <a href="https://github.com/maedaemaedae" target="_blank" class="font-semibold text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition">
                        Kayla Austria
                    </a>, and 
                    <a href="https://github.com/Koooyl" target="_blank" class="font-semibold text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition">
                        Kyle Fernandez
                    </a>
                </p>
            </div>
        </div>

        <!-- Footer Links -->
        <div class="flex flex-wrap justify-center sm:justify-end gap-4">
            <a href="#" class="hover:text-blue-600 dark:hover:text-blue-400 transition duration-300">Privacy Policy</a>
            <a href="#" class="hover:text-blue-600 dark:hover:text-blue-400 transition duration-300">Terms of Service</a>
            <a href="https://mail.google.com/mail/?view=cm&fs=1&to=ict.mimaroparegion@deped.gov.ph" 
               target="_blank" 
               class="hover:text-blue-600 dark:hover:text-blue-400 transition duration-300">
               Contact Us
            </a>
        </div>
    </div>
</footer>
