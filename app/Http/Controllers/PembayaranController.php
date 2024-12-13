<?php

// app/Http/Controllers/PembayaranController.php
namespace App\Http\Controllers;

use App\Exports\PembayaranExport;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Maatwebsite\Excel\Facades\Excel;
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
        // dd($request->all());
        //Log::info('Data request:', $request->all());
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'no_telp' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'jenis_paket' => 'required|string|in:Standard,Premium', // Hanya jenis paket yang diizinkan
            'harga' => 'required|numeric', // Validasi dasar harga
            'struk' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048', // Validasi file bukti pembayaran
        ]);
    
        // Validasi harga berdasarkan jenis_paket
        $harga_valid = false;
        if ($request->jenis_paket === 'Standard' && $request->harga == 500000) {
            $harga_valid = true;
        } elseif ($request->jenis_paket === 'Premium' && $request->harga == 5000000) {
            $harga_valid = true;
        }
    
        if (!$harga_valid) {
            return redirect()->back()->withErrors(['harga' => 'Harga tidak valid untuk jenis paket yang dipilih.']);
        }
    
        // Menyimpan file bukti pembayaran jika ada
        $struk = null;
        if ($request->hasFile('struk')) {
            $struk = $request->file('struk')->store('public/STRUK');
        }
    
        Pembayaran::create([
            'user_id' => auth::id(), // User yang melakukan pembayaran
            'name' => $request->name,
            'no_telp' => $request->no_telp,
            'email' => $request->email,
            'jenis_paket' => $validated['jenis_paket'], // Isi jenis_paket
            'harga' => $validated['harga'], // Harga paket
            'status' => 'pending', // Status default adalah pending
            'tanggal_pembayaran' => now(),
            'struk' => $struk ? str_replace('public/', '', $struk) : null, // Menyimpan path file jika ada
        ]);
    
        return redirect()->route('form.bayar')->with('success', 'Data anda berhasil disimpan. Silakan Menunggu untuk disetujui oleh Admin');
    }

    public function showFormBayar(Request $request)
{
    try {
        // Dekripsi parameter dari URL
        $paket = Crypt::decryptString($request->query('paket'));
        $harga = Crypt::decryptString($request->query('harga'));
    } catch (\Exception $e) {
        // Jika dekripsi gagal, redirect atau tampilkan pesan error
        return redirect()->route('home')->withErrors(['error' => 'Parameter tidak valid.']);
    }

    // Validasi paket dan harga
    $validPaket = ['Standard', 'Premium'];
    $validHarga = [500000, 5000000];

    if (!in_array($paket, $validPaket) || !in_array($harga, $validHarga)) {
        return redirect()->route('home')->withErrors(['error' => 'Parameter tidak valid.']);
    }

    // Tampilkan form pembayaran dengan parameter yang valid
    return view('form-bayar', compact('paket', 'harga'));
}
    
    public function showForm(Request $request)
    {
        // Ambil data dari query string
        $paket = $request->query('paket');
        $harga = $request->query('harga');

         $encryptedPaket = Crypt::encrypt($paket);
        $encryptedHarga = Crypt::encrypt($harga);
        // Kirim data ke view
        return view('pages.Pembayaran.formbayar', compact('paket', 'harga'));
    }
    

    public function edit(Pembayaran $pembayaran)
{
    return view('pages.Pembayaran.edit', compact('pembayaran'));
}

public function update(Request $request, $id)
{
    // Validasi input
    $request->validate([
        'status' => 'required|in:Approved,Rejected', // Hanya menerima status Approved atau Rejected
    ]);

    // Ambil data pembayaran berdasarkan ID
    $pembayaran = Pembayaran::findOrFail($id);

    // Ambil user terkait pembayaran
    $user = $pembayaran->user;

    // Cek apakah status yang dipilih adalah "Approved"
    if ($request->status == 'Approved') {
        // Tambahkan jenis_paket ke tabel users
        $user->jenis_paket = $pembayaran->jenis_paket;
        $user->save(); // Simpan perubahan pada tabel users
    }

    // Jika status adalah "Rejected"
    if ($request->status == 'Rejected') {
        // Kosongkan jenis_paket pada tabel users
        $user->jenis_paket = null;
        $user->save(); // Simpan perubahan pada tabel users
    }

    /// Update status pembayaran di tabel pembayarans
    $pembayaran->status = $request->status;
    $pembayaran->save();

    $pembayaran->update([
       
        'status' => $request->status, // Update status pembayaran
    ]);

    return redirect()->route('pembayaran.index', ['id' => $pembayaran->id])->with('success', 'Data berhasil diperbarui.');
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

