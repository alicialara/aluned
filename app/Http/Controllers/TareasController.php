<?php

namespace App\Http\Controllers;

use App\DedicacionHoras;
use App\Tareas;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;


class TareasController extends Controller
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
        $obj = Tareas::where(array('id_usuario' => \Auth::user()->id))->get();

        foreach($obj as $tarea){
            $results = DB::select("SELECT SUM(horas) AS suma FROM dedicacion_horas WHERE id_tarea=:id_tarea LIMIT 1", ['id_tarea' => $tarea->id]);
            if($results && count($results)>0 && !is_null($results[0]->suma)){
                $res = $results[0];
                $tarea->suma = $res->suma;
            }
            else $tarea->suma = 0;
        }


        // load the view and pass the nerds
        return View::make('tareas.index')
            ->with('tareas', $obj);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tareas.create');
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
            return Redirect::to('tareas/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $tarea = new Tareas();
            $tarea->id_usuario = \Auth::user()->id;
            $tarea->titulo = Input::get('titulo');
            $tarea->grupo = Input::get('grupo');
            $tarea->descripcion = Input::get('text');
            $tarea->estimacion_horas = Input::get('estimacion_horas');
            $tarea->prioridad = Input::get('prioridad');
            $tarea->activo = 1;
            $tarea->save();

            // redirect
            Session::flash('message', 'He hecho lo que he podido para crear la tarea.');
            return Redirect::to('/tareas');
        }
    }

    public function ver_desglose(){
        $data = Input::all();
        $id_tarea = (integer) $data['id_tarea'];

        $tarea = DedicacionHoras::where(array('id_tarea' => $id_tarea))->get();

        $html = DedicacionHoras::jsonToDebug(json_encode($tarea));

        return $html;
    }

//    public function anadir_horas(){
//        $data = Input::all();
//        $id_tarea = $data['id_tarea'];
//
//        $tarea = Tareas::find($id_tarea);
//
//        return json_encode($tarea);
//    }
    public function anadir_horas_dedicacion(){
        $data = Input::all();
        $id_tarea = $data['id_tarea'];
        $fecha = $data['fecha'];
        $horas = $data['horas'];

        $dedicacion = DedicacionHoras::firstOrNew(array('id_tarea' => $id_tarea, 'dia' => $fecha));
        $dedicacion->horas += $horas;
        $dedicacion->dia = $fecha;
        $dedicacion->id_tarea = $id_tarea;
        $dedicacion->save();



        return Redirect::to('/tareas');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
