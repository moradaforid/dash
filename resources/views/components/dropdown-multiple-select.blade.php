<div x-data='{items: {!!$items!!}, selectedValues: {{$selectedValues}}}' class="relative w-full text-sm text-gray-700 placeholder-gray-50 bg-gray-50 border border-gray-300 dark:border-gray-400 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple">
    <div class="p-2">
        Select Countries
    </div>
    <div class="absolute max-h-36 overflow-y-auto mt-2 right-0 left-0">
        <ul x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="p-2 space-y-2 text-gray-600 bg-white border border-gray-100 rounded-md shadow-md dark:border-gray-700 dark:text-gray-300 dark:bg-gray-600" aria-label="submenu">
            <template x-for="item in items">
                <li class="flex inline-flex items-center space-x-2 w-full p-2 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200">
                    <div class="w-4 h-4 rounded border dark:border-gray-200">
                        <svg class="w-full" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"></path>
                        </svg>
                    </div>
                    <span x-text="item.name"></span>
                </li>
            </template>

        </ul>
    </div>

</div>
<script>
    function dropdownMenu() {
        return {
            //

        }
    }
</script>