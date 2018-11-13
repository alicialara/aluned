<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Glosario;
use App\Apuntes;

use Illuminate\Foundation\Auth\User;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class GlosarioController extends Controller
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
        $obj = Glosario::all();

       
        $apuntes = Apuntes::where('created_at', '!=', NULL)->pluck('titulo', 'id')->toArray();

        // load the view and pass the nerds
        return View::make('glosario.index')
            ->with('glosario', $obj)
            ->with('apuntes', $apuntes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$apuntes = array('Seleccionar (opcional)') + Apuntes::where('created_at', '!=', NULL)->pluck('titulo', 'id')->toArray();

        return view('glosario.create')
        ->with('apuntes', $apuntes);
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
            'word'      => 'required|max:255'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('glosario/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $glosario = new Glosario();
            $glosario->word = Input::get('word');
            $glosario->description = Input::get('text');
            $glosario->id_apuntes = Input::get('id_apuntes');
            $glosario->save();

            // redirect
            Session::flash('message', 'Word added');
            return Redirect::to('/glosario');
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
