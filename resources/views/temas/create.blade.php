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

    <h1>Creación de nuevo tema</h1>

    <div class="col-md-8">

        {!! Form::open(array('url' => 'temas')) !!}

        {{ Form::token() }}

        <div class="form-group">
            {{ Form::input('text', 'titulo', null, ['class' => 'form-control', 'placeholder' => 'Título del tema']) }}
        </div>


        <div class="form-group">
            {{ Form::textArea('text', 'descripcion',['class' => 'form-control', 'value' => 'Descripción del tema']) }}
        </div>

        <div class="form-group">
            {{ Form::submit('Crear tema', array('class' => 'btn btn-block btn-success')) }}
        </div>
        {!! Form::close() !!}

    </div>

@endsection


