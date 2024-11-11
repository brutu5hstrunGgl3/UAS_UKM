<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;

class PembayaranController extends Controller
{
    public function invoicePreview(Request $request)
    {
        // Ambil data dari form sebelumnya dan tampilkan di halaman preview
        // dd($request->all());
        $data = [
            'order_id' => uniqid(), // ID unik untuk pesanan
            'name' => $request->input('name'),
            'no_telp' => $request->input('no_telp'),
            'email' => $request->input('email'),
            'paket' => $request->input('paket'),
            'harga' => $request->input('harga'),
            'tanggal_pembayaran' => $request->input('tanggal_pembayaran'),
        ];

        return view('pages.pembayaran.invoice', compact('data'));
    }

    public function invoiceConfirm(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'no_telp' => 'required',
            'email' => 'required',
            'paket' => 'required',
            'harga' => 'required',
            'status' => 'required',
            'struk' => 'required|mimes:jpg,jpeg,png,pdf|max:2048',
            'tanggal_pembayaran' => 'required',
        ]);

        // Menyimpan invoice
        if ($request->file('invoice_file')) {
            $filePath = $request->file('invoice_file')->store('invoices', 'public');
        }

        Pembayaran::create([
            'name' => $request->name,
            'no_telp' => $request->no_telp,
            'email' => $request->email,
            'paket' => $request->paket,
            'harga' => $request->harga,
            'status' => $request->status,
            'struk' => $filePath ?? null,
            'tanggal_pembayaran' => $request->tanggal_pembayaran,
        ]);

        return redirect()->route('home')->with('success', 'Pembayaran berhasil disimpan!');
    }

    public function form_bayar($paket, $harga)
    {
        return view('pages.pembayaran.form_bayar', compact('paket', 'harga'));
    }
}
