<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class EncryptRoute
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
        // Cek apakah parameter 'id' ada dan valid
        if ($request->has('id')) {
            try {
                $decryptedId = Crypt::decrypt($request->input('id'));
                $request->merge(['id' => $decryptedId]);
            } catch (\Exception $e) {
                return response()->json(['error' => 'Invalid ID'], 400);
            }
        }

        return $next($request);
    }
}
