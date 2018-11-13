<?php
/**
 * Created by PhpStorm.
 * User: alicia
 * Date: 4/25/2017
 * Time: 09:44
 */
?>

<?php $__env->startSection('content'); ?>
    <h1>Edición de apuntes</h1>
    <div class="">
        <?php echo Form::open(array('url' => 'apuntes')); ?>

        <?php echo e(Form::token()); ?>

        <?php echo e(Form::hidden('id_apuntes', $apuntes->id)); ?>

        <div class="form-group">
            <?php echo e(Form::input('text', 'titulo', $apuntes->titulo, ['class' => 'form-control', 'placeholder' => 'Título'])); ?>

        </div>
        <div class="form-group">
            <?php echo e(Form::textArea('text', html_entity_decode($apuntes->texto),['class' => 'form-control', 'value' => 'Descripción del tema'])); ?>

        </div>
        <div class="form-group">
            <?php echo e(Form::label('tarea', 'Se puede asociar a una tarea...', array('class' => ''))); ?>

            <?php echo e(Form::select('tarea', $tareas, $apuntes->id_tarea,['class' => 'form-control'])); ?>

        </div>
        <div class="form-group">
            <?php echo e(Form::label('tema', 'Se puede asociar a un tema...', array('class' => ''))); ?>

            <?php echo e(Form::select('tema', $temas, $apuntes->id_tema,['class' => 'form-control'])); ?>

        </div>
        <div class="form-group">
            <?php echo e(Form::label('encuesta', 'Se puede asociar a una encuesta...', array('class' => ''))); ?>

            <?php echo e(Form::select('encuesta', $encuestas, $apuntes->id_poll,['class' => 'form-control'])); ?>

        </div>
        <div class="form-group">
            <?php echo e(Form::label('publicar', '¿Hacer públicos los apuntes?', array('class' => ''))); ?>

            <?php echo e(Form::checkbox('publicar', null, $apuntes->publicar_bool ,['class' => ''])); ?>

        </div>
        <div class="form-group">
            <?php echo e(Form::submit('Crear apuntes', array('class' => 'btn btn-block btn-success'))); ?>

        </div>
        <?php echo Form::close(); ?>

    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>