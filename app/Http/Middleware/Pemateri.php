<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Pemateri
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {  
            $permision = $request->user()->rul;
        if($permision == 'PEMATERI') {
            return $next($request);
        } else {
            abort(500);
        }
        
    }
}
