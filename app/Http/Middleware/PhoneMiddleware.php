<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PhoneMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    /*public function handle(Request $request, Closure $next): Response
    {
        return $next($request);
    }*/

    public function handle($request, Closure $next)
    {
        if (auth()->user()->phone)
            return $next($request);

        $notification = 'Es necesario asociar un nro de teléfono para registrar citas.';
        return redirect('/profile')->with(compact('notification'));
    }  
}
