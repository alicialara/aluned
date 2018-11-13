<?php
/**
 * Created by PhpStorm.
 * User: alicia
 * Date: 10/10/2017
 * Time: 09:44
 */

?>



<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('temas.tablaindex', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>



<?php $__env->startPush('scripts_datatables'); ?>

<script>

    $(document).ready(function() {
        $(function() {

            $('.table').DataTable({
                responsive: true,
                paginate: false,
                "order": [[ 3, "desc" ]]
            });


            $('a[class*="anadir_ponente"]').click(function(e){
                e.preventDefault();
                var url = $(this).attr("href");
                console.log(url);
                $.get(url, function(data, status){
//                    alert("Data: " + data + "\nStatus: " + status);
                });
                location.reload();
//                $(this).html("Tema seleccionado").removeClass( "btn btn-sm btn-success btn-danger" );
            });

            $('a[class*="eliminar_ponente"]').click(function(e){
                e.preventDefault();
                var url = $(this).attr("href");
                console.log(url);
                $.get(url, function(data, status){
//                    alert("Data: " + data + "\nStatus: " + status);
                });
                location.reload();
//                $(this).html("Tema NO seleccionado").removeClass( "btn btn-sm btn-success btn-danger" );
            });

            $('a[class*="votar"]').click(function(e){
                e.preventDefault();
                var url = $(this).attr("href");
                $.get(url, function(data, status){
//                    alert("Data: " + data + "\nStatus: " + status);
                });
                location.reload();
//                $(this).html("Tema NO seleccionado").removeClass( "btn btn-sm btn-success btn-danger" );
            });


            $('select[class*="id_encuesta"]').change(function(){
                var id_tema = $(this).attr('id');
                var id_encuesta = $(this).val();
                var url = '/temas/select_encuesta?id_tema='+id_tema+'&id_encuesta='+id_encuesta;
                console.log(url);
                $.get(url, function(data, status){
//                    alert("Data: " + data + "\nStatus: " + status);
                });
                location.reload();
            });

        });



    } );
</script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>