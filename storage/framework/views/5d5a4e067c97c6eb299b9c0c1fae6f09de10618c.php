<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if(!isset($hide) || (isset($hide) && $cat->id != $hide->id)): ?>
        <option value="<?php echo e($cat->id); ?>" <?php echo e((isset($category) && $cat->id == $category->id) ? 'selected' : ''); ?>>
            <?php for($i = 0; $i < $cat->depth; $i++): ?>- <?php endfor; ?>
            <?php echo e($cat->title); ?>

        </option>
    <?php endif; ?>

    <?php if($cat->children): ?>
        <?php echo $__env->make('forum::category.partials.options', ['categories' => $cat->children], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
