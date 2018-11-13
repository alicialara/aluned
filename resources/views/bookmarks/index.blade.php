<?php
/**
 * Created by PhpStorm.
 * User: alicia
 * Date: 10/10/2017
 * Time: 09:44
 */

?>
@extends('layouts.app')


@section('content')
    @include('bookmarks.tablaindex')

@endsection



@push('scripts_datatables')

<script>

    $(document).ready(function() {
        $('.table').DataTable({
            responsive: true,
            paginate: false
        });


        

    } );
</script>

@endpush


