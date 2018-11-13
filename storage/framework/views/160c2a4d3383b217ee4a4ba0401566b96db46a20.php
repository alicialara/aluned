<?php $__env->startSection('content'); ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('createCategories')): ?>
        <?php echo $__env->make('forum::category.partials.form-create', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php endif; ?>

    <h2><?php echo e(trans('forum::general.index')); ?></h2>

    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <table class="table table-index">
            <thead>
                <tr>
                    <th><?php echo e(trans_choice('forum::categories.category', 1)); ?></th>
                    <th class="col-md-2"><?php echo e(trans_choice('forum::threads.thread', 2)); ?></th>
                    <th class="col-md-2"><?php echo e(trans_choice('forum::posts.post', 2)); ?></th>
                    <th class="col-md-2"><?php echo e(trans('forum::threads.newest')); ?></th>
                    <th class="col-md-2"><?php echo e(trans('forum::posts.last')); ?></th>
                </tr>
            </thead>
            <tbody>
                <tr class="category">
                    <?php echo $__env->make('forum::category.partials.list', ['titleClass' => 'lead'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </tr>
                <?php if(!$category->children->isEmpty()): ?>
                    <tr>
                        <th colspan="5"><?php echo e(trans('forum::categories.subcategories')); ?></th>
                    </tr>
                    <?php $__currentLoopData = $category->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo $__env->make('forum::category.partials.list', ['category' => $subcategory], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </tbody>
        </table>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('forum::master', ['category' => null], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>