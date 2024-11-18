<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckPaymentStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
    
        // Jika user adalah PESERTA dan status pembayaran belum disetujui
        if ($user->rul == 'PESERTA' && $user->payment_status != 'approved') {
            return redirect()->route('upload.payment.proof')
                             ->with('error', 'Anda harus menyelesaikan pembayaran untuk mengakses halaman ini.');
        }
    
        return $next($request);
    }
}    
