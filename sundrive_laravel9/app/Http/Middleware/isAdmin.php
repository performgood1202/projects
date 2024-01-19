<?php

namespace App\Http\Middleware;


use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Closure;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {


        if(Auth::user() && Auth::user()->role == "1"){

            return $next($request);

        }else{

            return abort(404);

        }

        
    }
}

