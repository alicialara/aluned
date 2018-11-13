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

    <h1>Creación de apuntes</h1>

    <div class="">

        {!! Form::open(array('url' => 'apuntes')) !!}

        {{ Form::token() }}

        <div class="form-group">
            {{ Form::input('text', 'titulo', null, ['class' => 'form-control', 'placeholder' => 'Título']) }}
        </div>

        <div class="form-group">
            {{ Form::label('tarea', 'Se puede asociar a una tarea...', array('class' => '')) }}
            {{ Form::select('tarea', $tareas, null,['class' => 'form-control']) }}
        </div>

        <div class="form-group">
            {{ Form::label('tema', 'Se puede asociar a un tema...', array('class' => '')) }}
            {{ Form::select('tema', $temas, null,['class' => 'form-control']) }}
        </div>

        <div class="form-group">
            {{ Form::label('encuesta', 'Se puede asociar a una encuesta...', array('class' => '')) }}
            {{ Form::select('encuesta', $encuestas, null,['class' => 'form-control']) }}
        </div>


        <div class="form-group">
            {{ Form::textArea('text', 'descripcion',['class' => 'form-control', 'value' => 'Descripción del tema']) }}
        </div>



        <div class="form-group">
            {{ Form::submit('Crear apuntes', array('class' => 'btn btn-block btn-success')) }}
        </div>
        {!! Form::close() !!}

    </div>

@endsection
<script></script>


