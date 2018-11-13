<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $id_user
 * @property int $id_poll
 * @property string $results
 * @property string $created_at
 * @property string $updated_at
 */
class PollUser extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'poll_user';

    /**
     * @var array
     */
    protected $fillable = ['id_user', 'id_poll', 'results', 'created_at', 'updated_at'];

}
