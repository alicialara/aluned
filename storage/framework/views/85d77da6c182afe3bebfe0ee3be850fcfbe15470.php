<?php
/**
 * Created by PhpStorm.
 * User: alicia
 * Date: 4/25/2017
 * Time: 09:44
 */
?>


<?php $__env->startSection('content'); ?>
    <div class="col-md-12>">

    </div>
    <div class="wrapper wrapper-content  animated fadeInRight article">
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="pull-right">
                            <a role="button" class="btn btn-info" type="button" href="/apuntes/<?php echo e($apuntes->id); ?>/edit"><i class="fa fa-paste"></i> Editar</a>
                            <a role="button" class="btn btn-success " type="button" target="_blank" href="/apuntes/descargar_pdf/<?php echo e($apuntes->id); ?>"><i class="fa fa-download"></i>&nbsp;&nbsp;<span class="bold">Descargar en PDF</span></a>
                        </div>
                        <div class="text-center article-title">
                            <span class="text-muted"><i class="fa fa-clock-o"></i> 28th Oct 2015</span>
                            <h1>
                                <?php echo e($apuntes->titulo); ?>

                            </h1>
                        </div>


                        <?php
                        if($apuntes->titulo_tarea != '') echo '<h3>Tarea: '.$apuntes->titulo_tarea.'</h3>';
                        if($apuntes->titulo_encuesta != '') echo '<h3>Encuesta: '.$apuntes->titulo_encuesta.'</h3>';
                        if($apuntes->titulo_tema != '') echo '<h3>Tema: '.$apuntes->titulo_tema.'</h3>';
                        ?>
                        <?php echo html_entity_decode($apuntes->texto); ?>



                    </div>
                </div>
            </div>
        </div>


    </div>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>