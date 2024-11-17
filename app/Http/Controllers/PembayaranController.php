<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class PembayaranController extends Controller
{

    public function index(Request $request)
    {
        $pembayaran = DB::table('pembayarans')
            ->when($request->input('name'), function ($query, $name) {
                return $query->where('name', 'like', '%' . $name . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('pages.Pembayaran.list_pembayaran', compact('Pembayaran'));
    }

    public function create()
    {
        return view('pages.Pembayaran.invoice');
    }


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

    public function form_bayar($encrypted)
    {
        try {
            // Dekripsi data paket dan harga dari URL
            $data = Crypt::decrypt($encrypted);
    
            $paket = $data['paket'];
            $harga = $data['harga'];
    
            return view('pages.pembayaran.form_bayar', compact('paket', 'harga'));
        } catch (\Exception $e) {
            abort(404, 'Data tidak valid.');
        }
    }

    public function redirectToFormBayar($paket, $harga)
{
    $encrypted = Crypt::encrypt(['paket' => $paket, 'harga' => $harga]);

    return redirect()->route('pages.Pembayaran.form_bayar', ['encrypted' => $encrypted]);
}
}
