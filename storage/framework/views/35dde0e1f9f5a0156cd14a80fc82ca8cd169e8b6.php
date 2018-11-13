<?php
/**
 * Created by PhpStorm.
 * User: alicia
 * Date: 4/25/2017
 * Time: 09:44
 */


?>


<?php $__env->startSection('content'); ?>

    <h1>Add new word</h1>

    <div class="">

        <?php echo Form::open(array('url' => 'glosario')); ?>


        <?php echo e(Form::token()); ?>


        <div class="form-group">
            <?php echo e(Form::input('text', 'word', null, ['class' => 'form-control', 'placeholder' => 'Word'])); ?>

        </div>

        <div class="form-group">
            <?php echo e(Form::textArea('text', 'descripcion',['class' => 'form-control', 'value' => 'Descripción del tema'])); ?>

        </div>

        <div class="form-group">
            <?php echo e(Form::label('id_apuntes', 'Se puede asociar a unos apuntes...', array('class' => ''))); ?>

            <?php echo e(Form::select('id_apuntes', $apuntes, null,['class' => 'form-control'])); ?>

        </div>


       
        <div class="form-group">
            <?php echo e(Form::submit('Create', array('class' => 'btn btn-block btn-success'))); ?>

        </div>
        <?php echo Form::close(); ?>


    </div>

<?php $__env->stopSection(); ?>
<script></script>



<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>