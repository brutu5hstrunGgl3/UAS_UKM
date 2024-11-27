<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Pembayaran;

class Peserta
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Pastikan peserta memiliki peran "PESERTA"
        if ($request->user()->rul == 'PESERTA') {
            // Ambil nama pengguna yang sedang login
            $userName = $request->user()->name;
            
            // Cari data pembayaran berdasarkan nama pengguna (kolom 'name' pada tabel users)
            $pembayaran = Pembayaran::whereHas('user', function ($query) use ($userName) {
                $query->where('name', $userName);
            })->first();
    
            // Periksa apakah status pembayaran adalah "Sudah Bayar"
            if ($pembayaran && $pembayaran->status == 'Sudah Bayar') {
                // Jika sudah bayar dan terverifikasi, lanjutkan request
                return $next($request);
            }
    
            // Jika pembayaran belum valid atau belum dibayar, arahkan pengguna ke halaman yang sesuai
            return redirect('/dashboard')->with('error', 'Anda belum menyelesaikan pembayaran atau belum divalidasi oleh admin.');
        }
    
        return $next($request);
    }
    
}
