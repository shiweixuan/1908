<?php

namespace App\Http\Middleware;

use Closure;

class ArticalLogin
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
        $user=session('admin');
        if(!$user){
            return view('/login');
        }
        return $next($request);
    }
}
