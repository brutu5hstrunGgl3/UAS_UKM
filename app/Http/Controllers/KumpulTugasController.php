<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KumpulTugas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log; 
use Illuminate\Support\Facades\Storage;


class KumpulTugasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index( Request $request)
    {
        $name = $request->input('name');
        $kelas = $request->input('kelas');
        $kumpul_tugas = DB::table('kumpul_tugas')
        ->when($request->input('name'), function ($query, $name) {
            return $query->where('name', 'like', '%' . $name . '%');
        })
        //->select('id', 'name', 'email', 'phone', DB::raw('DATE_FORMAT(created_at, "%d %M %Y") as created_at'))
        ->orderBy('id', 'desc')
        ->paginate(10);

        return view('pages.Kumpul.index',compact('kumpul_tugas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.Kumpul.upload' );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'file' => 'required|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:2048', // Validasi file
        ]);

        // Simpan file
        if ($request->hasFile('file')) {
            $filename = $request->file('file')->getClientOriginalName();
            // Simpan file ke dalam folder 'public/tugas'
            $request->file('file')->storeAs('public/tugas', $filename);


        $user = Auth::user();
        $pembayaran = $user->pembayaran; // Asumsikan ada relasi pembayaran di model User
        $jenisPaket = $pembayaran ? $pembayaran->jenis_paket : null; // Ambil jenis_paket atau null jika tidak ada pembayaran
    
        if (!$jenisPaket) {
            return redirect()->back()->with('error', 'Jenis Paket tidak ditemukan untuk user ini.');
        }

        // Simpan data ke tabel
        KumpulTugas::create([
            'name' => Auth::user()->name, // Nama otomatis dari user yang sedang login
            'jenis_paket' => $jenisPaket,
            'kelas'=> $request->input('kelas'),
            'file' => $filename,
            'tanggal_upload' => now(),

        ]);

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', ' File Tugas Anda  Berhasil Dikumpulkan!');
    }
}
   
public function download($id)
{
    // Cari tugas berdasarkan id
    $kumpul_tugas = KumpulTugas::find($id);

    // Jika tugas tidak ditemukan, redirect dengan pesan error
    if (!$kumpul_tugas) {
        return redirect()->route('kumpul.index')->with('error', 'Tugas tidak ditemukan.');
    }

    // Dapatkan path file dari storage
    $filePath = storage_path('app/public/tugas/' . $kumpul_tugas->file);

    // Periksa apakah file benar-benar ada
    if (!file_exists($filePath)) {
        return redirect()->route('kumpul.index')->with('error', 'File tidak ditemukan di server.');
    }

    // Download file
    return response()->download($filePath, $kumpul_tugas->file);
}
public function destroy($id)
{
    $tugas = KumpulTugas::find($id);
    
    if (!$tugas) {
        return redirect()->route('kumpul.index')->with('error', 'Tugas tidak ditemukan.');
    }

    // Tambahkan log sebelum menghapus
    Log::info('Menghapus tugas dengan ID: ' . $tugas->id);

    $tugas->delete();
    
    return redirect()->route('kumpul.index')->with('success', 'Data Anda berhasil dihapus.');
}

    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
  
}
