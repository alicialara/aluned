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

@endsection
@push('scripts_datatables')

<script>

    $(document).ready(function() {
        $(function() {

            $('.table').DataTable({
//                "scrollX": true,
//                responsive: true,
                paginate: false,
                render: $.fn.dataTable.render.text()
            });
			$('.table').render.text()
        });
    } );
</script>

@endpush