@extends('layouts.app')
<?php $phpArray = array(); ?>
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="row">

                    <?php

                    foreach ($user->unreadNotifications as $notification) {
                        echo '<div id="alert_notif" class="alert alert-'.$notification->data['type'].'  fade in">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                              '.$notification->data['text'].'
                            </div>';
                    }
//                    foreach ($user->unreadNotifications as $notification) {
//                        $notification->markAsRead();
//                    }
//                    $user->unreadNotifications->markAsRead();
//                    $user->unreadNotifications()->update(['read_at' => Carbon::now()]);
//                    $user->notifications()->delete();
                        ?>
                </div>
                <div class="row">
                    <div class="col-md-6"><div id='calendar'></div></div>
                    <div class="col-md-6">
                        <div class="wrapper wrapper-content animated fadeInUp">
                            <ul class="notes">
                                @if($seminario_esta_semana)
                                @foreach($seminario_esta_semana as $seminarios)
                                    <?php $aux = array(); ?>
                                    <?php $aux['title'] = 'Seminario LSI';  ?>
                                    <?php $aux['start'] = $seminarios->fecha_sin_format;  ?>
                                    <li>
                                        <div style="text-align: center;">
                                            {{--<small>12:03:28 12-04-2014</small>--}}
                                            <h4>Aviso de siguiente seminario</h4>
                                            <p><i class="fa fa-3x fa-calendar"></i></p>
                                            <p style="font-size: 15px;"><b>{{ $seminarios->date_formatted }}</b></p>
                                            <p style="font-size: 15px;"><b>{{ $seminarios->hora }}:00</b></p>
                                        </div>
                                    </li>
                                        <?php $phpArray[] = $aux; ?>
                                @endforeach
@endif
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@push('scripts_datatables')
<script>
    function toDate(dateStr) {
        var parts = dateStr.split("-");
        return new Date(parts[2], parts[1] - 1, parts[0], parts[3]);
    }
    $(document).ready(function() {

        // page is now ready, initialize the calendar...




        /* initialize the calendar
         -----------------------------------------------------------------*/
        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();
        var arrayFromPHP = <?php echo json_encode($phpArray); ?>

        $.each(arrayFromPHP, function( k, v ) {
            var start = v['start'];
            aux = toDate(start);
            v['start'] = aux;
            console.log(v);
        });



        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            editable: true,
            droppable: true, // this allows things to be dropped onto the calendar
            drop: function() {
                // is the "remove after drop" checkbox checked?
                if ($('#drop-remove').is(':checked')) {
                    // if so, remove the element from the "Draggable Events" list
                    $(this).remove();
                }
            },
            events: arrayFromPHP
        });



        $('#alert_notif').on('close.bs.alert', function () {
            $.get( "/notifications/markasread", function( data ) {
                console.log("notificaciones eliminadas juajuajua");
            });
        });

    });
</script>
@endpush
