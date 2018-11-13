<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apuntes extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'apuntes';

    /**
     * @var array
     */
    protected $fillable = ['id_usuario', 'id_poll', 'id_tema', 'id_tarea', 'titulo', 'texto', 'publicar', 'created_at', 'updated_at'];
}
