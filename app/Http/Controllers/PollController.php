<?php

namespace App\Http\Controllers;

use App\Poll;
use App\PollUser;
use App\Temas;
use DateInterval;
use DatePeriod;
use DateTime;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

use Illuminate\Foundation\Auth\User;


class PollController extends Controller
{
    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('getUserRole');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $obj = Poll::all();
        $titulos = array();
        foreach($obj as $poll){
            $titulo_tema = DB::table('temas')->where('id_encuesta', $poll->id)->value('titulo');
            $titulos[$poll->id] = $titulo_tema;
        }

        // load the view and pass the nerds
        return View::make('poll.index')
            ->with('poll', $obj)
            ->with('titulos_temas', $titulos);
    }

    public function create_poll_week(Request $request){
//        if($GLOBALS['ADMIN']){
  //          Session::flash('message', 'Sólo los superpoderosos administradores pueden crear encuestas muahaha.');
  //          Session::flash('alert-class', 'alert-danger');
  //          return redirect('/encuesta/');
  //      }
        $date_start = $request->input('date_start');
        $plus_days = $request->input('plus_days');
        if(!isset($plus_days)) $plus_days = 0;

        if(isset($date_start)){
            $date_start = str_replace("_"," ",$date_start);
        }else $date_start = 'next monday';

        $monday = new DateTime($date_start);
        $monday = $monday->modify('+' . $plus_days . ' days');
        $endDate = clone $monday;
        // Add 7 days to start date
        $endDate->modify('+5 days');
        // Increase with an interval of one day
        $dateInterval = new DateInterval('P1D');
        $dateRange = new DatePeriod($monday, $dateInterval, $endDate);

        $hours = ["10", "11", "12", "15", "16", "17"];

        $data = array();
        foreach ($dateRange as $d) {
            $date = $d->format('d-m-Y');
            $data[$date] = $hours;
        }
        $data = json_encode($data);

        $obj = Poll::firstOrNew(array('options' => $data));
        $obj->options = $data;
        $obj->save();

        self::enviar_mail_solicitar_encuesta($obj->id);

        return redirect('/encuesta/'.$obj->id.'/edit');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('poll.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    public function calculacosas($id){
        $poll = Poll::find($id);
        if(!$poll || $poll == null){
            Session::flash('message', 'Error: No se encuentra la encuesta seleccionada. Busca mejor la próxima vez.');
            Session::flash('alert-class', 'alert-danger');
            return Redirect::to('encuesta');
        }


        $titulo_tema = DB::table('temas')->where('id_encuesta', $poll->id)->value('titulo');



        $ids_usuarios = array();
        $usuarios_total = array();
        $usuarios = DB::table('users')
            ->select('users.id','users.name')
            ->get();

        $array_auxiliar_usuarios_votos = array();
        foreach($usuarios as $usu){
            $ids_usuarios[] = $usu->id;
            $array_auxiliar_usuarios_votos[$usu->id] = array();
            $usuarios_total[$usu->id] = $usu->name;
        }

        $votes = DB::table('users')
            ->leftJoin('poll_user', function($join) use($id)
            {
                $join->on('users.id', '=', 'poll_user.id_user')
                    ->where('poll_user.id_poll', '=', $id);
            })
            ->select('users.id as id_usuario','users.name', 'poll_user.*')

            ->get()->toArray();

        $options = $poll->options;
        $options = json_decode($options);
        $cuenta_fechas = array();
        $cuenta_usuarios = array();
        $cuenta_usuarios_id = array();


        foreach($votes as $vote){
            if(!is_null($vote->results)) {
                $result_ = str_replace('"', "", $vote->results);
                $result_ = explode('|', $result_);
                $array_auxiliar = array();
                foreach ($result_ as $aux_) {
                    $data_ = explode(',', $aux_);
                    $fecha = $data_[0] . ',' . $data_[1];
                    $valor = (float)$data_[2];
                    if ($valor == 3) $valor = 0.5;
                    $array_auxiliar[$fecha] = $valor;
                }
                array_push($array_auxiliar_usuarios_votos[$vote->id_usuario], $array_auxiliar);
            }
            foreach($options as $day => $hours){
                foreach($hours as $hour){

                    $row_basic = $day . "," . $hour;
                    $row = $vote->id_usuario ."," . $day . "," . $hour;
                    if(!is_null($vote->results)){
                        if (array_key_exists($row_basic, $array_auxiliar)) {
                            if(isset($cuenta_fechas[$row_basic])){
                                $cuenta_fechas[$row_basic] += $array_auxiliar[$row_basic];
                                array_push($cuenta_usuarios[$row_basic], $vote->name);
                                array_push($cuenta_usuarios_id[$row_basic], $vote->id_usuario);
                            } else {
                                $cuenta_fechas[$row_basic] = $array_auxiliar[$row_basic];
                                $cuenta_usuarios[$row_basic] = array($vote->name);
                                $cuenta_usuarios_id[$row_basic] = array($vote->id_usuario);
                            }
                        }
                    }else{

                    }
                }
            }
        }

        //Busco el mayor valor
        if(count($cuenta_fechas)>0)
            $value_max = max($cuenta_fechas);
        else $value_max = 0;
        $fechas_mejores = array_keys($cuenta_fechas,$value_max);


        $resultados_finales = array();


        foreach($fechas_mejores as $fecha){
            $usuarios_no_disponibles = array();
            $usuarios_disponibles = $cuenta_usuarios_id[$fecha];
            $ids_usuarios_no_disponibles = array_diff($ids_usuarios,$usuarios_disponibles);
            foreach($ids_usuarios_no_disponibles as $id_u){
                array_push($usuarios_no_disponibles, $usuarios_total[$id_u]);
            }
            $resultados_finales[$fecha] = array(
                'total_votos' => $cuenta_fechas[$fecha],
                'usuarios_disposibles' => $cuenta_usuarios[$fecha],
                'usuarios_no_disposibles' => $usuarios_no_disponibles
            );

        }

        //Busco el tercero en discordia




        $cuentas = array(
            'cuenta_fechas' => $cuenta_fechas,
            'fechas_mejores' => $fechas_mejores,
            'cuenta_usuarios' => $cuenta_usuarios
        );
        return array(
            'poll' => $poll,
            'votes' => $votes,
            'cuentas' => $cuentas,
            'resultados_finales' => $resultados_finales,
            'titulo_tema' => $titulo_tema
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $salida = self::calculacosas($id);
        return View::make('poll.show')
            ->with('poll', $salida['poll'])
            ->with('cuentas', $salida['cuentas'])
            ->with('disabled', 'disabled')
            ->with('votes', $salida['votes'])
            ->with('resultados_finales', $salida['resultados_finales'])
            ->with('titulo_tema', $salida['titulo_tema'])
            ->with('id_usuario_actual', Auth::user()->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * Aquí se supone que está la página de votar y mostrar los resultados de la encuesta.
     * Cada persona sólo puede votar para su usuario
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $salida = self::calculacosas($id);
        return View::make('poll.show')
            ->with('poll', $salida['poll'])
            ->with('cuentas', $salida['cuentas'])
            ->with('disabled', '')
            ->with('votes', $salida['votes'])
            ->with('resultados_finales', $salida['resultados_finales'])
            ->with('titulo_tema', $salida['titulo_tema'])
            ->with('id_usuario_actual', Auth::user()->id)
            ;
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function actualiza_encuesta()
    {
        $data = Input::all();
        $id = $data['id_encuesta'];
        unset($data['_token']);
        unset($data['id_encuesta']);

        $resultados_usuarios = array();
        foreach($data as $key => $value){
            $aux = explode(",", $key);
            $id_user = $aux[0];
            $date = $aux[1];
            $hour = $aux[2];
            $row = $date . "," . $hour . "," . $value;



            if(isset($resultados_usuarios[$id_user])){
                $resultados_usuarios[$id_user] .= '|'.$row;
            }
            else {
                $resultados_usuarios[$id_user] = $row;
            }



        }
        foreach($resultados_usuarios as $id_usuario => $result){
            $obj = PollUser::firstOrNew(array('id_poll' => $id, 'id_user' => $id_usuario));
            $obj->results = json_encode($result);
            $obj->save();
        }

        Session::flash('message', 'TOMAAAAA');
        Session::flash('alert-class', 'alert-danger');
        return Redirect::to('encuesta/'.$id.'/edit');
    }

    public function selecciona_fecha_final(){
        $data = Input::all();
        $poll = Poll::find($data['id_poll']);
        $poll->seleccionada = $data['fecha'];
        $poll->save();

        if($GLOBALS['ADMIN']){
            self::enviar_mail_fecha_seleccionada($poll);
        }
//        self::enviar_mail_fecha_seleccionada($poll);
        return Redirect::to('encuesta/'.$poll->id.'/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function enviar_mail_fecha_seleccionada($encuesta){

        $users = User::where('enviar_mails', 1)->get();
        $data = array();
        $data['link_encuesta'] = 'http://aluned.laraclares.com/encuesta/'.$encuesta->id;

        $fecha_seleccionada = explode(",",$encuesta->seleccionada);
        $fecha = $fecha_seleccionada[0];
        $hora = $fecha_seleccionada[1].':00';
        $data['fecha'] = $fecha;
        $data['hora'] = $hora;

        foreach($users as $user){
            $email = $user->email;
            Mail::send('email.basicfinencuesta', $data, function($message) use ($email) {
                $message->to($email)->subject('[Resultados] Encuesta-LSI de la semana');
            });
        }

        Mail::send('email.reservaraula', $data, function($message) use ($email, $fecha,$hora) {
            $message->to('alara@lsi.uned.es')->subject('LSI reserva de aula 1.03 el '.$fecha. " a las ".$hora);
            $message->to('secretaria@lsi.uned.es')->subject('LSI reserva de aula 1.03 el '.$fecha. " a las ".$hora);
        });
    }

    public function enviar_mail_solicitar_encuesta($id_encuesta){

        $users = User::where('enviar_mails', 1)->get();
        $data = array();
        $data['link_encuesta'] = 'http://aluned.laraclares.com/encuesta/'.$id_encuesta.'/edit';
        foreach($users as $user){
            $email = $user->email;
            Mail::send('email.basic', $data, function($message) use ($email) {
                $message->to($email)->subject('Encuesta-LSI de la semana');
            });
        }
    }
}
