<?php
/**
 * Created by PhpStorm.
 * User: alicia
 * Date: 1/18/2017
 * Time: 12:11 AM
 */

namespace App\Http\Controllers;

use App\Log;
use Auth;



class MyUserPermissions
{

    public static function is_admin(){
        if (\Auth::check()) {
            $id_usuario = \Auth::user()->id;
            if($id_usuario == 1) return true;
        }
        return false;
    }
    public static function save_log_data($ruta, $data){
        //También almaceno en logs
        if (\Auth::check()) {
            $log = new Log();
            $log->id_usuario = \Auth::user()->id;
            $log->key = $ruta;
            if(isset($data->value)){
                if(len($data->value) > 500) 
                    $data->value = substr($data->value, 0, 500);
            }
            $log->value = json_encode($data);
            $log->save();
        }
    }
    public static function get_id_usuario(){
        return \Auth::user()->id;
    }
    public static function get_user_name(){
        return \Auth::user()->name;
    }

}