<div class="col-md-12">
    <div class="row">

        <div class="panel panel-default">
            <div class="panel-heading">Lista de tareas</div>
            <div class="panel-body">
                <div class="col-md-12">
                    <a role="button" class="btn btn-info btn-block" title="Crear nuevo poll semanal" href="/tareas/create" target="_blank">Crear nueva tarea</a>
                </div>
                <div class="col-md-12" style="margin-top: 20px;">
                    <table class="table display compact" id="" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Grupo</th>
                            <th>Tarea</th>
                            <th>Prioridad</th>
                            <th>Horas estimadas</th>
                            <th>Horas total</th>
                            <th>Fechas</th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tareas as $tarea)
                            <tr>
                                <td>{{ $tarea->activo }}</td>
                                <td>{{ $tarea->grupo }}</td>
                                <td><span title="{{ $tarea->descripcion }}">{{ $tarea->titulo }}</span></td>
                                <td>{{ $tarea->prioridad }}</td>
                                <td>{{ $tarea->estimacion_horas }}</td>
                                <td><button class="btn btn-sm btn-info anadir_horas" value="{{ $tarea->id }}">{{ $tarea->suma }}</button></td>
                                <td>{{ $tarea->created_at }}</td>
                                <td><button class="btn btn-sm btn-info ver_desglose" value="{{ $tarea->id }}">Ver desglose</button></td>
                                <td><a href="/apuntes?id_tarea={{ $tarea->id }}" class="btn btn-success btn-block btn-xs" target="_blank">Ver apuntes</a> </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>
</div>
