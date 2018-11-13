<?php $__env->startSection('content'); ?>
    <div class="col-md-6">
        <h1><?php echo e($thread->subject); ?></h1>
        <?php echo $__env->renderEach('messenger.partials.messages', $thread->messages, 'message'); ?>

        <?php echo $__env->make('messenger.partials.form-message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>