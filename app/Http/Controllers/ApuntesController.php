<?php

namespace App\Http\Controllers;

use App\Apuntes;
use App\Poll;
use App\Tareas;
use App\Temas;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

use Barryvdh\DomPDF\Facade as PDF;

class ApuntesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $action = Route::getCurrentRoute()->getActionName();
        if(strpos($action, 'descargar_pdf') == false){
            $this->middleware('auth');
            $this->middleware('getUserRole');
        }

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(Input::get('id_usuario')){
            $array = array(
                'id_usuario' => Input::get('id_usuario'),
                'publicar' => 1
            );
        }else{
            $array = array(
                'id_usuario' => \Auth::user()->id
            );
        }
        if(Input::get('id_tema')){
            $array += ['id_tema' => Input::get('id_tema')];
        }
        if(Input::get('id_tarea')){
            $array +=  ['id_tarea' => Input::get('id_tarea')];
        }
        if(Input::get('id_poll')){
            $array +=  ['id_poll' => Input::get('id_poll')];
        }
        if($GLOBALS['ADMIN']){
            $obj = Apuntes::all();
        }else{
            $obj = Apuntes::where($array)
                ->orWhere(function ($query) use ($array) {
                    unset($array['id_usuario']);
                    $query->where('publicar', '=', 1)
                        ->where($array);
                })->get();
        }


        $temas[0] = '';
        $tareas[0] = '';
        $encuestas[0] = '';
        $usuarios = User::where('id' ,'>' ,0)->pluck('name', 'id')->toArray();
        $tareas = $temas + Tareas::where('created_at', '!=', NULL)->pluck('titulo', 'id')->toArray();
        $temas =  $tareas + Temas::where('created_at', '!=', NULL)->pluck('titulo', 'id')->toArray();
        $encuestas = $encuestas + Poll::where('created_at', '!=', NULL)->pluck('seleccionada', 'id')->toArray();


        // load the view and pass the nerds
        return View::make('apuntes.index')
            ->with('apuntes', $obj)
            ->with('usuarios', $usuarios)
            ->with('tareas', $tareas)
            ->with('temas', $temas)
            ->with('encuestas', $encuestas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tareas = array('Seleccionar (opcional)') + Tareas::where('id_usuario', \Auth::user()->id)->pluck('titulo', 'id')->toArray();
        $temas = array('Seleccionar (opcional)') +  Temas::where('created_at', '!=', NULL)->pluck('titulo', 'id')->toArray();
        $encuestas = array('Seleccionar (opcional)') + Poll::where('created_at', '!=', NULL)->pluck('seleccionada', 'id')->toArray();


        // load the view and pass the nerds
        return View::make('apuntes.create')
            ->with('tareas', $tareas)
            ->with('temas', $temas)
            ->with('encuestas', $encuestas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'titulo'      => 'required|max:255'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('apuntes/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            if(Input::get('id_apuntes') && !is_null(Input::get('id_apuntes'))){
                $apuntes = Apuntes::find(Input::get('id_apuntes'));
            }else $apuntes = new Apuntes();
            $apuntes->id_usuario = \Auth::user()->id;
            $apuntes->titulo = Input::get('titulo');
            $apuntes->texto = Input::get('text');
            $apuntes->id_tarea = Input::get('tarea');
            $apuntes->id_tema = Input::get('tema');
            $apuntes->id_poll = Input::get('encuesta');
            $publicar = Input::get('publicar');
            if($publicar) $publicar = 1; else $publicar = 0;

            $apuntes->publicar = $publicar;
            $apuntes->save();

            // redirect
            Session::flash('message', 'He hecho lo que he podido para crear los apuntes.');
            return Redirect::to('/apuntes/'.$apuntes->id.'/edit');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $apuntes = Apuntes::find($id);
        if($apuntes->id_tarea && !is_null($apuntes->id_tarea) && $apuntes->id_tarea != 0){
            $obj = Tareas::find($apuntes->id_tarea);
            $apuntes->titulo_tarea = $obj->titulo;
        }else $apuntes->titulo_tarea = '';
        if($apuntes->seleccionada && !is_null($apuntes->seleccionada) && $apuntes->seleccionada != 0){
            $obj = Poll::find($apuntes->id_poll);
            $apuntes->titulo_encuesta = $obj->seleccionada;
        }else $apuntes->titulo_encuesta = '';
        if($apuntes->id_tema && !is_null($apuntes->id_tema) && $apuntes->id_tema != 0){
            $obj = Temas::find($apuntes->id_tema);
            $apuntes->titulo_tema = $obj->titulo;
        }else $apuntes->titulo_tema = '';

        return View::make('apuntes.show')
            ->with('apuntes', $apuntes);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $tareas = array('Seleccionar (opcional)') + Tareas::where('id_usuario', \Auth::user()->id)->pluck('titulo', 'id')->toArray();
        $temas = array('Seleccionar (opcional)') +  Temas::where('created_at', '!=', NULL)->pluck('titulo', 'id')->toArray();
        $encuestas = array('Seleccionar (opcional)') + Poll::where('created_at', '!=', NULL)->pluck('seleccionada', 'id')->toArray();

        $apuntes = Apuntes::find($id);

        if($apuntes->publicar == 1) $apuntes->publicar_bool = true; else $apuntes->publicar_bool = false;

        return View::make('apuntes.edit')
            ->with('tareas', $tareas)
            ->with('temas', $temas)
            ->with('encuestas', $encuestas)
            ->with('apuntes', $apuntes);
    }

    public function descargar_pdf($id){
        $apuntes = Apuntes::find($id);
        if($apuntes->publicar == 1){
            $this->middleware('auth');
            $this->middleware('getUserRole');
        }
        $html = '<h1>'.$apuntes->titulo.'</h1>';
        if($apuntes->id_tarea && !is_null($apuntes->id_tarea) && $apuntes->id_tarea != 0){
            $obj = Tareas::find($apuntes->id_tarea);
            $html .= '<h2>Tarea : '.$obj->titulo.'</h2>';
        }
        if($apuntes->seleccionada && !is_null($apuntes->seleccionada) && $apuntes->seleccionada != 0){
            $obj = Poll::find($apuntes->id_poll);
            $html .= '<h2>Encuesta : '.$obj->seleccionada.':00</h2>';
        }
        if($apuntes->id_tema && !is_null($apuntes->id_tema) && $apuntes->id_tema != 0){
            $obj = Temas::find($apuntes->id_tema);
            $html .= 'Tema : <h2>'.$obj->titulo.'</h2>';
        }

        $pdf = App::make('dompdf.wrapper');

        $html .= $apuntes->texto;
        $pdf->loadHTML($html);
        return $pdf->stream();
//        $pdf = PDF::loadView('pdf.invoice', $apuntes->texto);
//        return $pdf->download('invoice.pdf');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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


}
