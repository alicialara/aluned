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
            @include('temas.tablaindex')
        </div>
    </div>
@endsection
@push('scripts_datatables')

<script>
    $(document).ready(function() {
        $('.table').DataTable({
            paginate: false
        });
    });
</script>




@endpush