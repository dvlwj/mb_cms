<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Admin
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
        if (Auth::user()->userlevel != "admin" ) {
            return redirect('/home')->with('message', 'Anda tidak memiliki hak akses untuk halaman tersebut !');
        }
        return $next($request);
    }
}
