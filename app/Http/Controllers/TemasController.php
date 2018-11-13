<?php

namespace App\Http\Controllers;

use App\Poll;
use \App\Temas;
use \App\PuntuacionesTemas;
use Auth;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
class TemasController extends Controller
{
    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $obj = Temas::all();
        $polls = Poll::all();

        //Para cada tema, calculo puntuación total

        foreach ($obj as $tema){
            $id_tema = $tema->id;
            $id_ponente = $tema->id_usuario_ponente;

            $usuario = User::find($id_ponente);
            if(isset($usuario) && !is_null($usuario))
                $tema->nombre_usuario_ponente = $usuario->name;
            else $tema->nombre_usuario_ponente = '';

            $results = DB::select("SELECT SUM(puntuaciones_temas.puntuacion) AS suma FROM temas
                    INNER JOIN puntuaciones_temas ON temas.id = puntuaciones_temas.id_tema AND temas.id = :id_tema
                    GROUP BY puntuaciones_temas.id_tema LIMIT 1", ['id_tema' => $id_tema]);




            if($results && count($results)>0)
                $tema->puntuacion = $results[0]->suma;
            else $tema->puntuacion = 0;

            $results_puntuacion = DB::select("SELECT puntuacion FROM puntuaciones_temas WHERE id_usuario = :id_usuario AND id_tema = :id_tema LIMIT 1", ['id_tema' => $id_tema, 'id_usuario' => \Auth::user()->id]);
            if($results_puntuacion && count($results_puntuacion)>0)
                $tema->puntuacion_usuario = $results_puntuacion[0]->puntuacion;
            else $tema->puntuacion_usuario = 0;


        }

        // load the view and pass the nerds
        return View::make('temas.index')
            ->with('temas', $obj)
            ->with('polls', $polls)
            ->with('id_usuario_actual', \Auth::user()->id);
    }

    public function anadir_ponente(){
        $data = Input::all();
        $id_tema = $data['id_tema'];
        $id_ponente = $data['id_ponente'];

        $tema = Temas::find($id_tema);
        $tema->id_usuario_ponente = $id_ponente;
        $tema->save();

        return json_encode(array(
            'data' => 'OK'
        ));
    }

    public function eliminar_ponente(){
        $data = Input::all();
        $id_tema = $data['id_tema'];

        $tema = Temas::find($id_tema);
        $tema->id_usuario_ponente = null;
        $tema->save();

        return json_encode(array(
            'data' => 'OK'
        ));
    }

    public function votar(){
        $data = Input::all();
        $voto = $data['voto'];
        $id_tema = $data['id_tema'];

        $tema = PuntuacionesTemas::firstOrNew(array('id_tema' => $id_tema, 'id_usuario' => \Auth::user()->id));
        $tema->puntuacion = $voto;
        $tema->save();


        return json_encode(array(
            'data' => 'OK'
        ));
    }

    public function select_encuesta(){
        $data = Input::all();
        $id_encuesta = $data['id_encuesta'];
        $id_tema = $data['id_tema'];

        $tema = Temas::find($id_tema);
        $tema->id_encuesta = $id_encuesta;
        $tema->save();


        return json_encode(array(
            'data' => 'OK'
        ));
    }

    public function create(){
        return View::make('temas.create');
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
            return Redirect::to('tema/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $titulo = Input::get('titulo');
            $tema = new Temas();
            $tema->titulo = $titulo;
            $tema->descripcion = Input::get('text');
            $tema->save();

            // redirect
            Session::flash('message', 'He hecho lo que he podido para crear el tema.');
            return Redirect::to('/temas');
        }
    }
}
