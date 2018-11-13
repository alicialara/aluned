<?php

namespace App\Http\Middleware;
use App\Http\Controllers\MyUserPermissions;
use App\Log;

use Closure;
use Illuminate\Support\Facades\Route;

class getUserRole
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $es_admin = MyUserPermissions::is_admin();
        $GLOBALS['ADMIN'] = false;
        if($es_admin) $GLOBALS['ADMIN'] = true;
        $ruta = Route::getCurrentRoute()->getName();
        MyUserPermissions::save_log_data($ruta, $GLOBALS['_POST']);


        return $next($request);
    }
}
