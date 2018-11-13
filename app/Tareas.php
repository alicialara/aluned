<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tareas extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tareas';

    /**
     * @var array
     */
    protected $fillable = ['titulo', 'grupo', 'descripcion', 'estimacion_horas', 'prioridad', 'activo', 'created_at', 'updated_at'];
}
