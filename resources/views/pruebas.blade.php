@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="wrapper wrapper-content animated fadeInUp">
            <ul class="notes">
                <li>
                    <div>
                        <small>12:03:28 12-04-2014</small>
                        <h4>Long established fact</h4>
                        <p>The years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>
                        <a href="#"><i class="fa fa-trash-o "></i></a>
                    </div>
                </li>

            </ul>
        </div>
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