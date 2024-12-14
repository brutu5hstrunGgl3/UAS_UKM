<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\PDF;

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

    public function exportToPDF(Request $request)
    {
        // Query untuk mengambil data pembayaran
        $pembayarans = Pembayaran::when($request->nama, function ($query, $nama) {
            return $query->where('name', 'like', '%' . $nama . '%');
        })
        ->latest() // Urutkan dari yang terbaru
        ->get();

        $dataPerusahaan = [
            'nama' => 'Komputer 77',
            'alamat' => 'Bantilang Kab.Luwu timur , Provinsi Sulawesi Selatan, Indonesia.',
            'telepon'=> '+628123456789',
            'email' => 'komputer77@bimbel.com',
            'website' => 'www.komputer77.com',
            'logo' => asset('public/img/payment/jcb.png'), // Ganti dengan path ke logo perusahaan Anda
        ]; 
        // Ambil semua data untuk PDF

        // Buat PDF
        $pdf = PDF::loadView('pages.Pembayaran.pdf', compact('pembayarans', 'dataPerusahaan'));
        // Download PDF
        return $pdf->download('history_pembayaran.pdf');
    }
}