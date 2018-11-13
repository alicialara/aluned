<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
Route::get('/', 'HomeController@index')->name("main");
Route::get('/minor', 'HomeController@minor')->name("minor");

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/encuesta/crear_semana', 'PollController@create_poll_week');
Route::get('/encuesta/enviar_mail_solicitar_encuesta/{id}', 'PollController@enviar_mail_solicitar_encuesta');
Route::post('/encuesta/actualiza_encuesta','PollController@actualiza_encuesta');
Route::get('/encuesta/selecciona_fecha_final','PollController@selecciona_fecha_final');

Route::resource('/encuesta', 'PollController');

Route::get('/temas/anadir_ponente', 'TemasController@anadir_ponente');
Route::get('/temas/eliminar_ponente', 'TemasController@eliminar_ponente');
Route::get('/temas/votar', 'TemasController@votar');
Route::get('/temas/select_encuesta', 'TemasController@select_encuesta');
Route::resource('/temas', 'TemasController');

Route::get('/tareas/ver_desglose', 'TareasController@ver_desglose');
//Route::get('/tareas/anadir_horas', 'TareasController@anadir_horas');
Route::post('/tareas/anadir_horas_dedicacion', 'TareasController@anadir_horas_dedicacion');
Route::resource('/tareas', 'TareasController');

Route::get('/apuntes/descargar_pdf/{id}', 'ApuntesController@descargar_pdf');
Route::resource('/apuntes', 'ApuntesController');

Route::group(array('before' => 'auth'), function ()
{
    Route::get('/laravel-filemanager', '\Unisharp\Laravelfilemanager\controllers\LfmController@show');
    Route::post('/laravel-filemanager/upload', '\Unisharp\Laravelfilemanager\controllers\LfmController@upload');

});
Route::group(['prefix' => 'messages'], function () {
    Route::get('/', ['as' => 'messages', 'uses' => 'MessagesController@index']);
    Route::get('create', ['as' => 'messages.create', 'uses' => 'MessagesController@create']);
    Route::post('/', ['as' => 'messages.store', 'uses' => 'MessagesController@store']);
    Route::get('{id}', ['as' => 'messages.show', 'uses' => 'MessagesController@show']);
    Route::put('{id}', ['as' => 'messages.update', 'uses' => 'MessagesController@update']);
});

Route::get('/notifications/markasread', 'HomeController@eliminar_notificaciones');

Route::resource('/bookmarks', 'BookmarksController');
Route::resource('/glosario', 'GlosarioController');