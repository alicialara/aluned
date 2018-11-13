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

    <h1>Create new bookmark</h1>

    <div class="">

        {!! Form::open(array('url' => 'bookmarks')) !!}

        {{ Form::token() }}

        <div class="form-group">
            {{ Form::input('text', 'title', null, ['class' => 'form-control', 'placeholder' => 'Title']) }}
        </div>

        <div class="form-group">
            {{ Form::input('text', 'description', null, ['class' => 'form-control', 'placeholder' => 'Description']) }}
        </div>

        <div class="form-group">
            {{ Form::input('text', 'url', null, ['class' => 'form-control', 'placeholder' => 'URL']) }}
        </div>
      

       
        <div class="form-group">
            {{ Form::submit('Create', array('class' => 'btn btn-block btn-success')) }}
        </div>
        {!! Form::close() !!}

    </div>

@endsection
<script></script>


