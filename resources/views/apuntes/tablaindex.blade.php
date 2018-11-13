<div class="row">


        <div class="panel panel-default">
            <div class="panel-heading">Lista de apuntes</div>
            <div class="panel-body">
                <div class="col-md-12">
                    <a role="button" class="btn btn-info btn-block" title="Crear nuevo poll semanal" href="/apuntes/create">Crear nuevos apuntes</a>
                </div>
                <div class="col-md-12" style="margin-top: 20px;">
                    <table class="table display compact nowrap" id="" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th></th>

                            <th>Título</th>
                            <th>Usuario</th>
                            <th>Fecha creación</th>
                            <th>Tema</th>
                            <th>Tarea</th>
                            <th>Encuesta</th>
                            <th>Fecha actualización</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($apuntes as $a)
                            <tr>

                                <td>{{ $usuarios[$a->id_usuario] }}</td>
                                <td><a href="/apuntes/{{ $a->id }}" class="btn btn-circle btn-info"> <i class="fa fa-search" aria-hidden="true"></i></a> </td>
                                <td><a href="/apuntes/{{ $a->id }}/edit"> <i class="fa fa-pencil" aria-hidden="true"></i> {{ $a->titulo }}</a></td>
                                <td>{{ $a->created_at }}</td>
                                <td>{{ $temas[$a->id_tema] }}</td>
                                <td>{{ $tareas[$a->id_tarea] }}</td>
                                <td>{{ $encuestas[$a->id_poll] }}</td>

                                <td>{{ $a->updated_at }}</td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

</div>
