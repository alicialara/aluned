<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PuntuacionesTemas extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'puntuaciones_temas';

    /**
     * @var array
     */
    protected $fillable = ['id', 'id_tema','id_usuario','puntuacion', 'created_at', 'updated_at'];
}
