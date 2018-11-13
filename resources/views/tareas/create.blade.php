<?php
/**
 * Created by PhpStorm.
 * User: alicia
 * Date: 4/25/2017
 * Time: 09:44
 */


?>
@extends('layouts.app')

@section('content')

    <h1>Creación de nueva tarea</h1>

    <div class="">

        {!! Form::open(array('url' => 'tareas')) !!}

        {{ Form::token() }}

        <div class="form-group">
            {{ Form::input('text', 'grupo', null, ['class' => 'form-control', 'placeholder' => 'Grupo del tema (MUSACCES, UNED, CONGRESOS, ...)']) }}
        </div>

        <div class="form-group">
            {{ Form::input('text', 'titulo', null, ['class' => 'form-control', 'placeholder' => 'Título del tema']) }}
        </div>


        <div class="form-group">
            {{ Form::textArea('text', 'descripcion',['class' => 'form-control', 'value' => 'Descripción del tema']) }}
        </div>

        <div class="form-group">
            {{ Form::label('prioridad', 'Prioridad (1... 10)', array('class' => '')) }}
            {{ Form::input('number', 'prioridad', 1,['class' => 'form-control']) }}
        </div>

        <div class="form-group">
            {{ Form::label('estimacion_horas', 'Estimación (horas)', array('class' => '')) }}
            {{ Form::input('number', 'estimacion_horas', 1,['class' => 'form-control']) }}
        </div>

        <div class="form-group">
            {{ Form::submit('Crear tarea', array('class' => 'btn btn-block btn-success')) }}
        </div>
        {!! Form::close() !!}

    </div>

@endsection
<script></script>


