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
    <div class="col-md-12">
        <div class="row">
            @include('poll.tablavoting')
        </div>
    </div>
@endsection
@push('scripts_datatables')

<script>
    $(document).ready(function() {
//        $('.table').DataTable({
//            paginate: false
//        });
//
//
//        $('a[class*="selecciona_fecha_final"]').click(function(e){
//            e.preventDefault();
//            var url = $(this).attr("href");
//            $.get(url, function(data, status){
////                    alert("Data: " + data + "\nStatus: " + status);
//            });
//            location.reload();
////                $(this).html("Tema NO seleccionado").removeClass( "btn btn-sm btn-success btn-danger" );
//        });

    });
</script>




@endpush