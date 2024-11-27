<?php

// app/Http/Controllers/PembayaranController.php
namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Storage;

class PembayaranController extends Controller


{

    public function index(Request $request)

    {
        $pembayarans = DB::table('pembayarans')
        ->when($request->input('name'), function ($query, $name) {
            return $query->where('name', 'like', '%' . $name . '%');
        })
        //->select('id', 'name', 'email', 'phone', DB::raw('DATE_FORMAT(created_at, "%d %M %Y") as created_at'))
        ->orderBy('id', 'desc')
        ->paginate(10);


        
        return view('pages.Pembayaran.index' , compact('pembayarans'));
    }




    public function formBayar()
    {
        return view('pages.Pembayaran.formbayar');
    }

    public function storePembayaran(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'no_telp' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'jenis_paket' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'tanggal_pembayaran' => 'required|date',
            'struk' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048', // Validasi file bukti pembayaran
        ]);

        
        // Menyimpan file bukti pembayaran jika ada
        if ($request->hasFile('struk')) {
            $filePath = $request->file('struk')->store('uploads/struk', 'public'); // Menyimpan file di folder public/uploads/struk
        }
     
        

        Pembayaran::create([
            'name' => $request->name,
            'no_telp' => $request->no_telp,
            'email' => $request->email,
            'jenis_paket' => $request->jenis_paket,
            'harga' => $request->harga,
            'status' => 'Belum Bayar',
            'tanggal_pembayaran' => $request->tanggal_pembayaran,
            'struk' => $filePath ?? null,
            'user_id' => Auth::id(), // Menyimpan path file jika ada
            
        ]);

        return redirect()->route('form.bayar')->with('success', 'Data anda berhasil disimpan. Silakan Menunggu untuk disetujui oleh Admin');
    }

    public function showForm(Request $request)
    {
        // Ambil data dari query string
        $paket = $request->query('paket');
        $harga = $request->query('harga');

        // Kirim data ke view
        return view('pages.Pembayaran.formbayar', compact('paket', 'harga'));
    }

    public function edit(Pembayaran $pembayaran)
{
    return view('pages.Pembayaran.edit', compact('pembayaran'));
}

public function update(Request $request, Pembayaran $pembayaran)
{
    $request->validate([
       
        'status' => 'required|in:Belum Bayar,Sudah Bayar', // Validasi status
    ]);

    $pembayaran->update([
       
        'status' => $request->status, // Update status pembayaran
    ]);

    return redirect()->route('pembayaran.index')->with('success', 'Data berhasil diperbarui.');
}



    public function destroy(Pembayaran $pembayaran)
    {
        $pembayaran->delete();
       
       return redirect()->route('pembayaran.index')->with('success', 'Data anda berhasil di hapus');
    }
}

