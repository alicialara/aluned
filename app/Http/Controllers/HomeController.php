<?php

namespace App\Http\Controllers;

use App\Notifications\Notificaciones;
use App\Poll;
use App\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Notifications\InvoicePaid;
use Illuminate\Support\Facades\Notification;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('Locale');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        setlocale(LC_ALL,"es_ES");
        $seminario_esta_semana = DB::select( DB::raw("SELECT seleccionada FROM poll WHERE WEEKOFYEAR(STR_TO_DATE(SUBSTRING_INDEX(seleccionada, ',', 1), '%d-%m-%Y'))=WEEKOFYEAR(NOW())") );
        if($seminario_esta_semana && count($seminario_esta_semana)>0){
            foreach($seminario_esta_semana as $seminario){
                $selecc = explode(",", $seminario->seleccionada);
                $fecha = $selecc[0];
                $hora = $selecc[1];

                //Para jquery
                $fecha_jquery = explode("-",$fecha);
                $seminario->fecha_jquery = $fecha_jquery[2] . "/" . $fecha_jquery[0] . "/" . $fecha_jquery[1];

                $date = strftime("%A %d %B %Y", strtotime($fecha));
                $seminario->date_formatted = $date;
                $seminario->hora = $hora;
                $seminario->fecha_sin_format = $fecha.'-'.$hora;
            }
        }else $seminario_esta_semana = false;




//        Notification::send(Auth::user(), new Notificaciones(array('type' => 'success', 'text' => 'Esto es una noti')));



        return view('home')
            ->with('seminario_esta_semana',$seminario_esta_semana)
            ->with('user',Auth::user());
    }

    public function eliminar_notificaciones(){
        $user = Auth::user();
        $user->unreadNotifications->markAsRead();
    }
}
