<?php

namespace App\Http\Middleware;

use Closure;

class ApiGuard
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
        $token = $request->header('Authorization');
        if($token != 'fbb4a3ad-c797-4412-a52e-2ce6f51a28e0'){
            return response()->json(['message'=>'Unauthorized'], 401);
        }
        return $next($request);
    }
}
