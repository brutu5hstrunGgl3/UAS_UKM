<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class PaymentVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            // Cek status pembayaran pengguna
            $user = Auth::user();
            // $payment = $user->payments()->where('status', 'approved')->first();

            // Jika tidak ada pembayaran yang disetujui, arahkan ke halaman pembayaran
            // if (!$payment) {
            //     return redirect()->route('pages.Pembayaran.index')->with('error', 'Silakan lakukan pembayaran terlebih dahulu.');
            // }
        }

        return $next($request);
    }
}
