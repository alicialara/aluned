<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $id_usuario
 * @property string $key
 * @property string $value
 */
class Log extends Model
{
    protected $table = 'log';
    /**
     * @var array
     */
    protected $fillable = ['id_usuario', 'key', 'value'];

//    public function getLastAttribute() //Product::find(1)->lowest;
//    {
//        //do whatever you want to do
//        return 'lowest price';
//    }

}
