<?php
/**
 * Created by PhpStorm.
 * User: alicia
 * Date: 4/25/2017
 * Time: 09:44
 */


?>


<?php $__env->startSection('content'); ?>

    <h1>Creación de apuntes</h1>

    <div class="">

        <?php echo Form::open(array('url' => 'apuntes')); ?>


        <?php echo e(Form::token()); ?>


        <div class="form-group">
            <?php echo e(Form::input('text', 'titulo', null, ['class' => 'form-control', 'placeholder' => 'Título'])); ?>

        </div>

        <div class="form-group">
            <?php echo e(Form::label('tarea', 'Se puede asociar a una tarea...', array('class' => ''))); ?>

            <?php echo e(Form::select('tarea', $tareas, null,['class' => 'form-control'])); ?>

        </div>

        <div class="form-group">
            <?php echo e(Form::label('tema', 'Se puede asociar a un tema...', array('class' => ''))); ?>

            <?php echo e(Form::select('tema', $temas, null,['class' => 'form-control'])); ?>

        </div>

        <div class="form-group">
            <?php echo e(Form::label('encuesta', 'Se puede asociar a una encuesta...', array('class' => ''))); ?>

            <?php echo e(Form::select('encuesta', $encuestas, null,['class' => 'form-control'])); ?>

        </div>


        <div class="form-group">
            <?php echo e(Form::textArea('text', 'descripcion',['class' => 'form-control', 'value' => 'Descripción del tema'])); ?>

        </div>



        <div class="form-group">
            <?php echo e(Form::submit('Crear apuntes', array('class' => 'btn btn-block btn-success'))); ?>

        </div>
        <?php echo Form::close(); ?>


    </div>

<?php $__env->stopSection(); ?>
<script></script>



<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>