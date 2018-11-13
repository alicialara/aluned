<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('messenger.partials.flash', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <?php echo $__env->renderEach('messenger.partials.thread', $threads, 'thread', 'messenger.partials.no-threads'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>