<div class="col-md-12">
    <div class="row">

        <div class="panel panel-default">
            <div class="panel-heading">Lista de encuestas</div>
            <div class="panel-body">
                <div class="col-md-12">
                    <a role="button" class="btn btn-info btn-block" title="Crear nuevo poll semanal" href="/encuesta/create" target="_blank">Crear nueva encuesta</a>
                </div>
                <div class="col-md-12" style="margin-top: 20px;">
                    <table class="table table_modal display compact" id="users-table" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Tema</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $poll; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                            $options = json_decode($value->options);
                            $options = (array) $options;
                            ?>
                            <tr>
                                <td id="id_<?php echo e($value->id); ?>"><?php echo e($value->id); ?></td>
                                <td>
                                    <?php
                                        if(isset($titulos_temas[$value->id])) echo $titulos_temas[$value->id];
                                    ?>
                                </td>
                                <?php
                                reset($options);
                                $first_dia = key($options);
                                end($options);
                                $last_dia = key($options);

                                    $fecha = DateTime::createFromFormat('d-m-Y', $first_dia);
                                    $today = new DateTime('-3 days');
                                    if($fecha < $today) $activo = false;
                                    else $activo = true;
                                ?>
                                <td>
                                    <?php if($activo): ?>
                                        <a class="btn btn-small btn-info" href="<?php echo e(URL::to('encuesta/' . $value->id . '/edit')); ?>">Ir a encuesta</a>
                                    <?php else: ?>
                                        No se puede modificar
                                    <?php endif; ?>
                                </td>
                                <td><a href="/apuntes?id_poll=<?php echo e($value->id); ?>" class="btn btn-success btn-block btn-xs" target="_blank">Ver apuntes</a> </td>
                                <td id="options_<?php echo e($value->id); ?>"><?php echo e($first_dia); ?> a <?php echo e($last_dia); ?></td>

                                <td>
                                    <?php if(!$activo && is_null($value->seleccionada)): ?>
                                        <b style="color: red">CANCELADA</b>
                                    <?php else: ?>
                                        <a class="btn btn-small btn-info" href="<?php echo e(URL::to('encuesta/' . $value->id . '')); ?>">Ver resultados</a>
                                    <?php endif; ?>

                                        
                                </td>

                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>
</div>

