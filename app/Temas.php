<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Temas extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'temas';

    /**
     * @var array
     */
    protected $fillable = ['id', 'titulo', 'descripcion','id_usuario_ponente','id_encuesta', 'finalizado', 'created_at', 'updated_at'];
}
