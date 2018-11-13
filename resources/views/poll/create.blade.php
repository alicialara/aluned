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

    <h1>Creación de nueva encuesta</h1>

    <a role="button" class="btn btn-primary btn-block" href="/encuesta/crear_semana?date_start=today">Crear a partir de hoy</a>
    <a role="button" class="btn btn-primary btn-block" href="/encuesta/crear_semana?date_start=next_monday">Crear a partir del lunes que viene</a>
    <a role="button" class="btn btn-primary btn-block" href="/encuesta/crear_semana?date_start=next_monday&plus_days=7">Crear a partir del lunes dentro de dos semanas</a>
    <a role="button" class="btn btn-primary btn-block" href="/encuesta/crear_semana?date_start=next_monday&plus_days=14">Crear a partir del lunes dentro de tres semanas</a>

@endsection


