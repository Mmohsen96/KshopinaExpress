<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Client
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
        if (Auth::user()->complete == 1 && Auth::user()->type == 1 && Auth::user()->active == 1) {
            return $next($request);
        } elseif (Auth::user()->complete == 1 && Auth::user()->type == 1 && Auth::user()->active == 0) {
            return redirect('under_review')->with(['user' => Auth::user()]);
        } else {
            return redirect('/');
        }
    }
}
