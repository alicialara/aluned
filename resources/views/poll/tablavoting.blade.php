
    <?php
    $options = $poll->options;
    $options = json_decode($options);
    ?>
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">Encuesta -  <strong style="font-size: 16px;"><?php if(isset($titulo_tema)) echo $titulo_tema; ?></strong></div>
            <div class="panel-body">
                <div class="col-md-12">
                    <a role="button" class="btn btn-info btn-block" title="Crear nuevo poll semanal" href="/encuesta/create" target="_blank">Crear nueva encuesta</a>
                </div>
                <div class="col-md-12">
                    <?php



                        ?>

                </div>
                <div class="col-md-12" style="margin-top: 20px;">
                    {!! Form::open(array('url' => 'encuesta/actualiza_encuesta')) !!}

                    {{ Form::token() }}
                    {{ Form::hidden('id_encuesta',$poll->id) }}
                    <table class="table table_modal display compact cell-border tabla_voting" id="tabla_responsive_horizontal" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th rowspan="2">Usuario</th>


                                <?php

                                foreach($options as $day => $hours){
                                    echo '<th colspan="'.count($hours).'">'.$day.'</th>';
                                }

                                ?>


                        </tr>
                        <tr>
                            <?php
                            $total_dias = count($poll);
                            foreach($options as $day => $hours){
                                foreach($hours as $hour){
                                    echo '<th>'.$hour.'</th>';
                                }
                            }
                            ?>
                        </tr>

                        </thead>
                        <tbody>

                        <?php

                        foreach($votes as $vote){
                            echo '<tr>';
                            echo '<td>'.$vote->name.'</td>';

                            $resultados = array();
                            if(!is_null($vote->results)){
                                $result = str_replace('"',"",$vote->results);
                                $result = explode("|",$result);
                                foreach($result as $res){
                                    $aux_ = explode(",",$res);
                                    $resultados[$aux_[0] . "," . $aux_[1]] = (int) $aux_[2];
                                }
                            }


                            foreach($options as $day => $hours){
                                foreach($hours as $hour){
                                    $row_basic = $day . "," . $hour;
                                    $row = $vote->id_usuario ."," . $day . "," . $hour;

                                    $check = 0;
                                    $check_m = '';

                                    if(isset($resultados[$row_basic])){
                                        $check = $resultados[$row_basic];
                                        $check_m = 'checked';
                                    }
                                    $class_css = '';
                                    if($poll->seleccionada == $row_basic){
                                        $class_css = 'background_verde';
                                    }

                                    echo '<td class="'.$class_css.'">';

                                    $disabled_ = 'disabled';
                                    if($id_usuario_actual == $vote->id_usuario){
                                        $disabled_ = '';
                                    }


                                    echo '<label>
                                    <input type="checkbox" name="'.$row.'" id="'.$row.'"  '.$disabled.' '.$check_m.' value="'.$check.'" class="" '.$disabled_.'>';
                                    echo '<i class="fa fa-fw fa-close unchecked '.$row.'"></i>
                                            <i class="fa fa-fw fa-check checked '.$row.'"></i>
                                            <i class="fa fa-fw fa-hand-spock-o  undeterminate '.$row.'"></i>';

                                    echo '</label></td>';
                                }
                            }
                            echo '</tr>';
                        }
                        ?>
                        </tbody>
                    </table>
                    <div class="form-group">
                        @if($disabled == '')
                            {{ Form::submit('Actualizar encuesta', array('class' => 'btn btn-success')) }}
                        @endif
                    </div>


                    {!! Form::close() !!}
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <h3>Selección final:</h3>
                        <table class="table table_modal display compact cell-border hover" id="" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th rowspan="2">Fecha</th>
                                <th>Usuarios disponibles</th>
                                <th>Usuarios NO disponibles</th>
                                <th>Total puntuación</th>
                                <th>Selección final</th>
                            </tr>

                            </thead>
                            <tbody>


                            <?php
                            foreach($resultados_finales as $fecha => $data){

                                $fecha_ = explode(",",$fecha);
                                $date = date("F jS, Y", strtotime($fecha_[0]));
                                echo '<tr>';
                                echo '<td><b>'.$date.' '.$fecha_[1].':00</b></td>';
                                echo '<td>'.implode(" || ",$data['usuarios_disposibles']).'</td>';
                                echo '<td>'.implode(" || ",$data['usuarios_no_disposibles']).'</td>';
                                echo '<td>'.$data['total_votos'].'</td>';

                                $class = 'btn btn-warning selecciona_fecha_final';
                                $text = 'Seleccionar';
                                if($poll->seleccionada == $fecha){
                                    $class = '';
                                    $text = 'Fecha seleccionada';
                                }
                                echo '<td><a class="'.$class.'" href="/encuesta/selecciona_fecha_final?fecha='.$fecha.'&id_poll='.$poll->id.'">'.$text.'</a></td>';
                                echo '</tr>';
                            }
                            ?>



                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

        </div>

    </div>