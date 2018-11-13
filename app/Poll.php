<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $options
 * @property string $created_at
 * @property string $updated_at
 */
class Poll extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'poll';

    /**
     * @var array
     */
    protected $fillable = ['options', 'seleccionada', 'created_at', 'updated_at'];

}
