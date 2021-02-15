<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Auth;   
class AppMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $app = null, $permission = null)
    {
        
        if(Auth::user()->hasRole('admin'))
            return $next($request);
        
        if(!$request->user()->hasApp($app)) {
            return response()->json(['message' => 'unauthorized user']);
        }
       if($permission !== null && !$request->user()->can($permission)) {
            return response()->json(['message' => 'unauthorized']);
        }
        return $next($request); 
    }
}
