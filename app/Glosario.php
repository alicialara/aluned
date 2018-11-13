<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Glosario extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'glosario';

    /**
     * @var array
     */
    protected $fillable = ['word', 'description', 'id_apuntes'];
}
