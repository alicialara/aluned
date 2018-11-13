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
    <h1>Edición de apuntes</h1>
    <div class="">
        {!! Form::open(array('url' => 'apuntes')) !!}
        {{ Form::token() }}
        {{ Form::hidden('id_apuntes', $apuntes->id) }}
        <div class="form-group">
            {{ Form::input('text', 'titulo', $apuntes->titulo, ['class' => 'form-control', 'placeholder' => 'Título']) }}
        </div>
        <div class="form-group">
            {{ Form::textArea('text', html_entity_decode($apuntes->texto),['class' => 'form-control', 'value' => 'Descripción del tema']) }}
        </div>
        <div class="form-group">
            {{ Form::label('tarea', 'Se puede asociar a una tarea...', array('class' => '')) }}
            {{ Form::select('tarea', $tareas, $apuntes->id_tarea,['class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::label('tema', 'Se puede asociar a un tema...', array('class' => '')) }}
            {{ Form::select('tema', $temas, $apuntes->id_tema,['class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::label('encuesta', 'Se puede asociar a una encuesta...', array('class' => '')) }}
            {{ Form::select('encuesta', $encuestas, $apuntes->id_poll,['class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::label('publicar', '¿Hacer públicos los apuntes?', array('class' => '')) }}
            {{ Form::checkbox('publicar', null, $apuntes->publicar_bool ,['class' => '']) }}
        </div>
        <div class="form-group">
            {{ Form::submit('Crear apuntes', array('class' => 'btn btn-block btn-success')) }}
        </div>
        {!! Form::close() !!}
    </div>
@endsection