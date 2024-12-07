<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use PHPUnit\Runner\HookMethod;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $allowedRoles = ['ADMIN', 'PEMATERI'];

        // Jika pengguna tidak login
        if (!$request->user()) {
            abort(403, 'Unauthorized access.');
        }

        // Jika role pengguna adalah 'PESERTA', arahkan ke halaman home
        if ($request->user()->rul === 'PESERTA') {
            return redirect('/home');
        }

        // Jika pengguna tidak memiliki salah satu role yang diizinkan
        if (!in_array($request->user()->rul, $allowedRoles)) {
            abort(403, 'Unauthorized access.');
        }

        // Lanjutkan ke request berikutnya jika role valid
        return $next($request);

    
     


    }


    
}
