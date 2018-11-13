<?php
/**
 * Created by PhpStorm.
 * User: alicia
 * Date: 4/25/2017
 * Time: 09:44
 */


?>


<?php $__env->startSection('content'); ?>

    <h1>Creación de nueva tarea</h1>

    <div class="">

        <?php echo Form::open(array('url' => 'tareas')); ?>


        <?php echo e(Form::token()); ?>


        <div class="form-group">
            <?php echo e(Form::input('text', 'grupo', null, ['class' => 'form-control', 'placeholder' => 'Grupo del tema (MUSACCES, UNED, CONGRESOS, ...)'])); ?>

        </div>

        <div class="form-group">
            <?php echo e(Form::input('text', 'titulo', null, ['class' => 'form-control', 'placeholder' => 'Título del tema'])); ?>

        </div>


        <div class="form-group">
            <?php echo e(Form::textArea('text', 'descripcion',['class' => 'form-control', 'value' => 'Descripción del tema'])); ?>

        </div>

        <div class="form-group">
            <?php echo e(Form::label('prioridad', 'Prioridad (1... 10)', array('class' => ''))); ?>

            <?php echo e(Form::input('number', 'prioridad', 1,['class' => 'form-control'])); ?>

        </div>

        <div class="form-group">
            <?php echo e(Form::label('estimacion_horas', 'Estimación (horas)', array('class' => ''))); ?>

            <?php echo e(Form::input('number', 'estimacion_horas', 1,['class' => 'form-control'])); ?>

        </div>

        <div class="form-group">
            <?php echo e(Form::submit('Crear tarea', array('class' => 'btn btn-block btn-success'))); ?>

        </div>
        <?php echo Form::close(); ?>


    </div>

<?php $__env->stopSection(); ?>
<script></script>



<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>