<?php
/**
 * Created by PhpStorm.
 * User: alicia
 * Date: 10/10/2017
 * Time: 09:44
 */

?>



<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('bookmarks.tablaindex', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>



<?php $__env->startPush('scripts_datatables'); ?>

<script>

    $(document).ready(function() {
        $('.table').DataTable({
            responsive: true,
            paginate: false
        });


        

    } );
</script>

<?php $__env->stopPush(); ?>



<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>