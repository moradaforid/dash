
<?php $__env->startSection('pageTitle', isset($pageTitle) ? $pageTitle : 'Edit Role'); ?>
<?php $__env->startSection('content'); ?>
<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">
                    Edit Role
                </h2>
            </div>

        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="row row-cards">
            <div class="col-lg-12">
                <div class="row row-cards">
                    <div class="col-12">
                        <form action="/roles/<?php echo e($role->id); ?>" method="POST" class="card">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field("PATCH"); ?>
                            <div class="card-body">
                                <div class="row row-cards">



                                    <div class="col-sm-6 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Name</label>
                                            <input type="text" class="form-control" name="name" placeholder="Name" value="<?php echo e($role->name); ?>">
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-6">
                                        <div class="mb-3">
                                            <div class="form-label">Permissions</div>

                                            <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <label class="form-check form-check-inline form-switch">
                                                <input class="form-check-input" type="checkbox" name="permissions[]" value="<?php echo e($permission->name); ?>" <?php if(in_array($permission->name , $role_permissions)): ?> checked <?php endif; ?>>
                                                <span class="form-check-label"><?php echo e($permission->name); ?></span>
                                            </label>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <?php if($status === 'updated'): ?>
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600 dark:text-gray-400"><?php echo e(__('Saved.')); ?></p>
                                <?php endif; ?>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\21265\Desktop\Projects\laravel-vue\resources\views/role/edit.blade.php ENDPATH**/ ?>