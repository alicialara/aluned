<?php
/**
 * Created by PhpStorm.
 * User: alicia
 * Date: 10/10/2017
 * Time: 09:44
 */

?>



<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('tareas.tablaindex', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>



<?php $__env->startPush('scripts_datatables'); ?>

<script>

    $(document).ready(function() {
        $('.table').DataTable({
            responsive: true,
            paginate: false
        });


        $('button[class*="anadir_horas"]').click(function(e){
            e.preventDefault();
            var id_tarea = $(this).val();

            $("#myModal").find('.modal-title').html("Añadir horas");
            $("#myModal").find('input[name="id_tarea"]').val(id_tarea);
//                $("#myModal").find('.modal-body').html(data);
            $("#myModal").modal();
        });

        $('button[class*="ver_desglose"]').click(function(e){
            e.preventDefault();
            var id_tarea = $(this).val();

            $.get('/tareas/ver_desglose?id_tarea='+id_tarea, function(data, status){
//                    $("#myModal").find('.modal-title').html("Añadir horas");
                $("#myModal").find('.modal-body').html(data);
                $('.table_modal').unbind().DataTable({
                    responsive: true,
                    paginate: false,
                    "order": [[ 2, "asc" ]]
                });
                $("#myModal").modal();
            });


        });

    } );
</script>

<?php $__env->stopPush(); ?>



<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>