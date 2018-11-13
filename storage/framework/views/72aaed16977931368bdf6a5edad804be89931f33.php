<div class="col-md-12">
    <div class="row">

        <div class="panel panel-default">
            <div class="panel-heading">Glosary list</div>
            <div class="panel-body">
                <div class="col-md-12">
                    <a role="button" class="btn btn-info btn-block" title="Crear nuevo poll semanal" href="/glosario/create">New word</a>
                </div>
                <div class="col-md-12" style="margin-top: 20px;">
                    <table class="table display" id="" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Word</th>
                            <th>Description</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $glosario; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $glos): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><b><?php echo e($glos->word); ?></b></td>
                                <td><?php echo e(strip_tags($glos->description)); ?></td>
                                <?php if($glos->id_apuntes > 0): ?>
                                <td><a href="/apuntes/<?php echo e($glos->id_apuntes); ?>" class="btn btn-success btn-block">Abrir apuntes</a> </td>
                                <?php else: ?>
                                <td></td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>
</div>
