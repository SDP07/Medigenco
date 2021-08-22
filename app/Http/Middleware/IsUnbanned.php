<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class IsUnbanned
{
    public function handle($request, Closure $next)
    {
        if (auth()->check() && auth()->user()->banned) {        

            $redirect_to = "login";
            
                
            
            auth()->logout();

            

            $message = translate("You are banned");
            flash($message);
        
            
                return redirect()->route($redirect_to);
            
            
        }

        return $next($request);
    }
}
