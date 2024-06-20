
<?php $__env->startSection('pageTitle', isset($pageTitle) ? $pageTitle : 'Tests'); ?>
<?php $__env->startSection('content'); ?>

<main class="h-full overflow-y-auto">
    <div x-data="modal()" class="container px-6 mx-auto grid">

        <!-- page title and create button -->
        <div class="flex justify-between mt-6">
            <div class="mb-3 mr-6">
                <h2 class="text-2xl font-semibold text-gray-700 dark:text-gray-200">
                    Tests
                </h2>
            </div>
            <div class="mb-3">
                <button @click="openCreateModal(); editRow.service_provider_id = 1; editRow.status = 0 " class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    Create
                </button>
            </div>
        </div>

        <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.table','data' => ['name' => 'table_data','singularName' => 'Test','crudPath' => ''.e(route('test.index')).'','columns' => '[\'username\', \'password\', \'service_provider_id\', \'status\']','disabledSave' => '! (editRow.username && editRow.password)']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'table_data','singularName' => 'Test','crudPath' => ''.e(route('test.index')).'','columns' => '[\'username\', \'password\', \'service_provider_id\', \'status\']','disabledSave' => '! (editRow.username && editRow.password)']); ?>

             <?php $__env->slot('tableRows', null, []); ?> 
                <td x-text="row.username" class="px-4 py-3 text-sm font-semibold"></td>
                <td x-text="row.password" class="px-4 py-3 text-sm font-semibold"></td>
                <td x-text="row.provider.name" class="px-4 py-3 text-sm font-semibold"></td>
                <td x-text="row.status == 0 ? 'New' : 'Given'" class="px-4 py-3 text-sm"></td>
                <td class="px-4 py-3">
                    <div class="flex items-center space-x-4 text-sm justify-end">
                        <button @click="openEditModal(row)" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Edit">
                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                            </svg>
                        </button>
                        <button @click="openDeleteModal(row.id)" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Delete">
                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                </td>
             <?php $__env->endSlot(); ?>

             <?php $__env->slot('modalInputs', null, []); ?> 
                <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4 py-6">
                    <label class="w-full block text-sm space-y-2">

                        <span class="text-gray-700 dark:text-gray-400">Username</span>
                        <input x-model="editRow.username" require="" class="w-full p-2 text-sm text-gray-700 placeholder-gray-50 bg-gray-50 border border-gray-300 dark:border-gray-400 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input" placeholder="">

                        <span class="text-gray-700 dark:text-gray-400">Password</span>
                        <input x-model="editRow.password" require="" class="w-full p-2 text-sm text-gray-700 placeholder-gray-50 bg-gray-50 border border-gray-300 dark:border-gray-400 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input" placeholder="">

                        <span class="text-gray-700 dark:text-gray-400">Service Provider</span>
                        <select x-model="editRow.service_provider_id" require="" class="w-full p-2 text-sm text-gray-700 placeholder-gray-50 bg-gray-50 border border-gray-300 dark:border-gray-400 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input" placeholder="">
                            <option value="1">Nexon</option>
                            <option value="2">Trex</option>
                            <option value="3">Leon</option>
                            <option value="6">Other</option>
                            <option value="7">Other 2</option>
                        </select>

                        <span class="text-gray-700 dark:text-gray-400">status</span>
                        <select x-model="editRow.status" init="editRow.status ? : editRow.status = 0" require="" class="w-full p-2 text-sm text-gray-700 placeholder-gray-50 bg-gray-50 border border-gray-300 dark:border-gray-400 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input" placeholder="">
                            <option value="0">New</option>
                            <option value="1">Given</option>
                        </select>


                    </label>
                </div>
             <?php $__env->endSlot(); ?>


         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>




    </div>
    <br>


</main>





<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\21265\Desktop\Projects\laravel-vue\resources\views/test/index.blade.php ENDPATH**/ ?>