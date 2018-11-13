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
                        @foreach($glosario as $glos)
                            <tr>
                                <td><b>{{ $glos->word }}</b></td>
                                <td>{{ strip_tags($glos->description) }}</td>
                                @if($glos->id_apuntes > 0)
                                <td><a href="/apuntes/{{ $glos->id_apuntes }}" class="btn btn-success btn-block">Abrir apuntes</a> </td>
                                @else
                                <td></td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>
</div>
