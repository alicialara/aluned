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

            @include('poll.tablavoting')

@endsection
@push('scripts_datatables')

<script>

    $(document).ready(function() {


        $('.tabla_voting').DataTable({
            paginate: false,
            responsive: false
        });


        $('a[class*="selecciona_fecha_final"]').click(function(e){
            e.preventDefault();
            var url = $(this).attr("href");
            $.get(url, function(data, status){
//                    alert("Data: " + data + "\nStatus: " + status);
            });
            location.reload();
//                $(this).html("Tema NO seleccionado").removeClass( "btn btn-sm btn-success btn-danger" );
        });




    } );
</script>

@endpush