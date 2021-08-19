<?php
declare( strict_types = 1 );
namespace App\Http\Middleware;

use Exception;
use Closure;

class JwtAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        
        /**
        * aca voy a colocar la logica de validacion jwt por headers y cookie
        */

        #por ahora solo retorno el grupo de rutas que usan este Middleware
        return $next($request);
    }
}