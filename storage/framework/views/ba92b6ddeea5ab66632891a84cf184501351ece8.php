

        <div class="panel panel-default">
            <div class="panel-heading">Lista de temas</div>
            <div class="panel-body">
                <div class="col-md-12">
                    <a role="button" class="btn btn-info btn-block" title="Crear nuevo poll semanal" href="/temas/create" target="_blank">Crear nuevo tema</a>
                </div>
                <div class="col-md-12" style="margin-top: 20px;">
                    <table class="table table_modal display compact" id="users-table" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Título</th>
                            <th>Puntuación</th>
                            <th>Puntuación total</th>
                            <th>Ponente</th>
                            <th>Encuesta</th>
                            <th>Fecha creación</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $temas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tema): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <tr>
                                <td id="id_<?php echo e($tema->id); ?>"><?php echo e($tema->id); ?></td>
                                <td><span title="<?php echo e($tema->descripcion); ?>"><?php echo e($tema->titulo); ?></span></td>
                                <td>
                                    <?php
                                        if($tema->puntuacion_usuario == 0){
                                            echo '<a class="fa fa-star votar" href="/temas/votar?voto=1&id_tema='.$tema->id.'"></a>
                                                    <a class="fa fa-star votar" href="/temas/votar?voto=2&id_tema='.$tema->id.'"></a>
                                                    <a class="fa fa-star votar" href="/temas/votar?voto=3&id_tema='.$tema->id.'"></a>
                                                    <a class="fa fa-star votar" href="/temas/votar?voto=4&id_tema='.$tema->id.'"></a>
                                                    <a class="fa fa-star votar" href="/temas/votar?voto=5&id_tema='.$tema->id.'"></a>';
                                        }else{
                                            $total = 0;
                                            $max = 5;
                                            for($i=0;$i<$tema->puntuacion_usuario; $i++){
                                                $total++;
                                                echo '<a class="fa fa-star star_checked votar" href="/temas/votar?voto='.$total.'&id_tema='.$tema->id.'"></a>';
                                                $max--;
                                            }
                                            for($j=$max;$j>0;$j--){
                                                $total++;
                                                echo '<a class="fa fa-star votar" href="/temas/votar?voto='.$total.'&id_tema='.$tema->id.'"></a>';
                                            }
                                        }

                                        ?>

                                </td>
                                <td><?php echo e($tema->puntuacion); ?></td>
                                <td>
                                    <?php
                                        if(!isset($tema->nombre_usuario_ponente) || is_null($tema->nombre_usuario_ponente) || $tema->nombre_usuario_ponente == ''){
                                            echo '<a href="/temas/anadir_ponente?id_tema='.$tema->id.'&id_ponente='.$id_usuario_actual.'" role="button" class="btn btn-sm btn-success anadir_ponente">¡Quiero ser ponente!</a>';
                                        }else{
                                            if($tema->id_usuario_ponente == $id_usuario_actual){
                                                echo '<a href="/temas/eliminar_ponente?id_tema='.$tema->id.'&id_ponente='.$id_usuario_actual.'" role="button" class="btn btn-sm btn-danger eliminar_ponente">¡Ya no quiero ser ponente!</a>';
                                            }else{
                                                echo '<span>'.$tema->nombre_usuario_ponente.'</span>';
                                            }
                                        }
                                    ?>
                                </td>
                                <td>
                                    <select class="form-control id_encuesta" id="<?php echo e($tema->id); ?>">
                                        <option value="">Seleccionar encuesta</option>
                                        <?php
                                            foreach($polls as $poll){
                                                if($poll->seleccionada && !is_null($poll->seleccionada) && $poll->seleccionada != ''){

                                                    $option_selected = '';
                                                    if($tema->id_encuesta == $poll->id) $option_selected = 'selected';

                                                    $fecha_ = explode(",",$poll->seleccionada);
                                                    $date = date("F jS, Y", strtotime($fecha_[0]));
                                                    echo '<option value="'.$poll->id.'" '.$option_selected.'>'.$date.'</option>';
                                                }

                                            }
                                        ?>
                                    </select>

                                </td>
                                <td><?php echo e($tema->created_at); ?></td>
                                <td><a href="/apuntes?id_tema=<?php echo e($tema->id); ?>" class="btn btn-success btn-block btn-xs" target="_blank">Ver apuntes</a> </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
