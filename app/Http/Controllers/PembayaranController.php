<?php

// app/Http/Controllers/PembayaranController.php
namespace App\Http\Controllers;

use App\Exports\PembayaranExport;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
//excel
use Maatwebsite\Excel\Facades\Excel;
//log
use Illuminate\Support\Facades\Log;

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

    public function StorePembayaranRequest(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'no_telp' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'jenis_paket' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'struk' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048', // Validasi file bukti pembayaran
        ]);

        
        // Menyimpan file bukti pembayaran jika ada
        $struk = null;
        $struk = $request->file('struk')->getClientOriginalName();
        $struk = $request->file('struk')->store('public/STRUK');
        
        
     
        

        Pembayaran::create([
            'name' => $request->name,
            'no_telp' => $request->no_telp,
            'email' => $request->email,
            'jenis_paket' => $request->jenis_paket,
            'harga' => $request->harga,
            'status' => 'Belum Bayar',
            'tanggal_pembayaran' => now(),
            'struk' => $struk ? str_replace('public/', '', $struk) : null,
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

public function download($id)
{
  
    // Cari data pembayaran berdasarkan ID
    $pembayaran = Pembayaran::find($id);
    
    // Jika data tidak ditemukan
    if (!$pembayaran) {
        return redirect()->route('pembayaran.index')->with('error', 'Struk tidak ditemukan.');
    }

    // Periksa apakah kolom struk memiliki nilai
    if (!$pembayaran->struk) {
        return redirect()->route('pembayaran.index')->with('error', 'Struk belum diunggah.');
    }

    // Dapatkan path file dari storage
    $filePath = storage_path('app/public/STRUK/' . basename($pembayaran->struk));


    // dd($pembayaran->struk);

    // Periksa apakah file benar-benar ada
    if (!file_exists($filePath)) {
        Log::error("File tidak ditemukan: {$filePath}");
        return redirect()->route('pembayaran.index')->with('error', 'File tidak ditemukan di server.');
    }

    // Download file
    return response()->download($filePath, $pembayaran->file);

    
}




    public function destroy(Pembayaran $pembayaran)
    {
        $pembayaran->delete();
       
       return redirect()->route('pembayaran.index')->with('success', 'Data anda berhasil di hapus');
    }

    public function export()
{
    return Excel::download(new PembayaranExport, 'Pembayaran.xlsx');
}


 
}

