<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function history(Request $request)
    {
        // Query untuk mengambil data pembayaran
        $pembayarans = Pembayaran::when($request->nama, function ($query, $nama) {
            // Jika ada parameter pencarian
            return $query->where('name', 'like', '%' . $nama . '%');
        })
        ->latest() // Urutkan dari yang terbaru
        ->paginate(10); // Tampilkan 10 data per halaman

        return view('pages.Pembayaran.history', compact('pembayarans'));
    }
}