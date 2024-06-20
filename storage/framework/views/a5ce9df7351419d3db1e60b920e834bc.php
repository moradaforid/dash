
<?php $__env->startSection('pageTitle', isset($pageTitle) ? $pageTitle : 'Create an App'); ?>
<?php $__env->startSection('content'); ?>

<main class="h-full overflow-y-auto" x-data='{ categories : <?php echo $categories; ?> }'>
    <div class="container px-6 mx-auto grid">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Apps
        </h2>

        <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">

            <div class="flex md:flex-wrap">

                <label class="flex-1 block text-sm px-2 py-3">
                    <span class="text-gray-700 dark:text-gray-400">Name</span>
                    <input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Jane Doe">
                </label>

                <label class="flex-1 block text-sm px-2 py-3">
                    <span class="text-gray-700 dark:text-gray-400">Category</span>
                    <select x-model="$store.table_paginator.pager" x-init="$watch('$store.table_paginator.pager', value => $store.table_paginator.reset_paginator())" class="w-full text-md rounded border border-gray-200 dark:border-gray-500 text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-700 hover:border-gray-400 focus:outline-none appearance-none">
                        <option value="1">1</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="500">500</option>
                    </select>
                </label>


            </div>
            <br>









        </div>




    </div>
    <br>
</main>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\21265\Desktop\Projects\laravel-vue\resources\views/app/create.blade.php ENDPATH**/ ?>