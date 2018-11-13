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

    <h1>Add new word</h1>

    <div class="">

        {!! Form::open(array('url' => 'glosario')) !!}

        {{ Form::token() }}

        <div class="form-group">
            {{ Form::input('text', 'word', null, ['class' => 'form-control', 'placeholder' => 'Word']) }}
        </div>

        <div class="form-group">
            {{ Form::textArea('text', 'descripcion',['class' => 'form-control', 'value' => 'Descripción del tema']) }}
        </div>

        <div class="form-group">
            {{ Form::label('id_apuntes', 'Se puede asociar a unos apuntes...', array('class' => '')) }}
            {{ Form::select('id_apuntes', $apuntes, null,['class' => 'form-control']) }}
        </div>


       
        <div class="form-group">
            {{ Form::submit('Create', array('class' => 'btn btn-block btn-success')) }}
        </div>
        {!! Form::close() !!}

    </div>

@endsection
<script></script>


