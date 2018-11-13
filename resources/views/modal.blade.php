<!-- Modal -->
<div id="myModal" class="modal col-md-6 col-md-offset-3" role="dialog">
    {{--<div class="modal-dialog">--}}
            <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">

                {!! Form::open(array('url' => 'tareas/anadir_horas_dedicacion')) !!}

                {{ Form::token() }}
                {{ Form::hidden('id_usuario','') }}
                {{ Form::hidden('id_tarea','') }}

                <div class="form-group">
                    {{ Form::label('fecha', 'Fecha', array('class' => 'control-label')) }}
                    {{ Form::date('fecha', \Carbon\Carbon::now(), array('class' => 'form-control datepicker')) }}
                </div>

                <div class="form-group">
                    {{ Form::label('horas', 'Horas', array('class' => 'control-label')) }}
                    {{ Form::number('horas', 0, array('class' => 'form-control')) }}
                </div>

                <div class="form-group">
                    {{ Form::submit('Actualizar', array('class' => 'btn btn-success')) }}
                </div>


                {!! Form::close() !!}

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
        {{--</div>--}}

    </div>
</div>