<?php
/**
 * Created by PhpStorm.
 * User: alicia
 * Date: 4/25/2017
 * Time: 09:44
 */


?>


<?php $__env->startSection('content'); ?>

    <h1>Create new bookmark</h1>

    <div class="">

        <?php echo Form::open(array('url' => 'bookmarks')); ?>


        <?php echo e(Form::token()); ?>


        <div class="form-group">
            <?php echo e(Form::input('text', 'title', null, ['class' => 'form-control', 'placeholder' => 'Title'])); ?>

        </div>

        <div class="form-group">
            <?php echo e(Form::input('text', 'description', null, ['class' => 'form-control', 'placeholder' => 'Description'])); ?>

        </div>

        <div class="form-group">
            <?php echo e(Form::input('text', 'url', null, ['class' => 'form-control', 'placeholder' => 'URL'])); ?>

        </div>
      

       
        <div class="form-group">
            <?php echo e(Form::submit('Create', array('class' => 'btn btn-block btn-success'))); ?>

        </div>
        <?php echo Form::close(); ?>


    </div>

<?php $__env->stopSection(); ?>
<script></script>



<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>