<h2>Add a new message</h2>
<form action="<?php echo e(route('messages.update', $thread->id)); ?>" method="post">
    <?php echo e(method_field('put')); ?>

    <?php echo e(csrf_field()); ?>

        
    <!-- Message Form Input -->
    <div class="form-group">
        <textarea name="message" class="form-control"><?php echo e(old('message')); ?></textarea>
    </div>

    <?php if($users->count() > 0): ?>
        <div class="checkbox">
            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <label title="<?php echo e($user->name); ?>">
                    <input type="checkbox" name="recipients[]" value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?>

                </label>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>

    <!-- Submit Form Input -->
    <div class="form-group">
        <button type="submit" class="btn btn-primary form-control">Submit</button>
    </div>
</form>