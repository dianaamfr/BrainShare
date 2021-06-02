<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckBlocked
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->ban) { 
            $message = 'Your account has been suspended.';
            auth()->logout();     
            return redirect()->route('login')->with('message-ban', $message); 
        }
 
        return $next($request);
    }
}
