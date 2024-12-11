<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\nilai;
use App\Http\Requests\StoreNilaiRequest;
use Illuminate\Support\Facades\DB;
use App\Imports\NilaiImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
//auth


class NilaiController extends Controller
{
    //index
    public function index(Request $request)
    {
        // Mengambil data pengguna dan nilai terkait
        $users = User::with('nilai') // Mengambil relasi nilai
        ->where('rul', 'PESERTA') // Hanya user dengan rul 'PESERTA'
        ->paginate(10);
        // Mengirim data ke view
        return view('pages.nilai.index', compact('users'));
    }

    public function create($id)
    {
        $user = User::findOrFail($id);
        return view('pages.nilai.create', compact('user'));
    }

    public function edit($id)
    {
    $nilai = Nilai::findOrFail($id);
    $user = $nilai->user; // Asumsikan relasi Nilai ke User sudah dibuat
    return view('pages.nilai.create', compact('nilai', 'user')); // Gunakan view yang sama dengan create
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'kehadiran' => 'required',
            'kompetensi' => 'required',
            'skill' => 'required',
            'status' => 'required',
        ]);
    
        $nilai = Nilai::findOrFail($id);
    
        // Jika ada file baru di-upload
        if ($request->hasFile('file_nilai')) {
            // Hapus file lama jika ada
            if ($nilai->file_nilai) {
                Storage::delete('public/' . $nilai->file_nilai);
            }
            // Simpan file baru
        $filePath = $request->file('file_nilai')->store('public/nilai');
        $validatedData['file_nilai'] = str_replace('public/', '', $filePath);
    }
        $nilai->update($validatedData);
        return redirect()->route('nilai.index')->with('success', 'Data nilai berhasil diperbarui.');
    }
    
    

    public function store(Request $request)
{
    $validatedData = $request->validate([
        'user_id' => 'required|exists:users,id',
        'kehadiran' => 'required',
        'kompetensi' => 'required',
        'skill' => 'required',
        'status' => 'required',
        'file_nilai' => 'nullable|file|mimes:pdf,docx,doc|max:2048', // Validasi file
    ]);
    
    // Perbaiki logika upload file
    if ($request->hasFile('file_nilai')) {
        // Simpan file dengan nama unik
        $filePath = $request->file('file_nilai')->store('public/nilai');
        
        // Tambahkan path file ke validated data
        $validatedData['file_nilai'] = str_replace('public/', '', $filePath);
    }

    // Buat record nilai
    $nilai = Nilai::create($validatedData);

    return redirect()->route('nilai.index')->with('success', 'Data berhasil disimpan.');
}

public function download($id)
{
    $nilai = Nilai::findOrFail($id); // Pastikan model Nilai diimport di controller
    $filePath = storage_path('app/public/' . $nilai->file_nilai);

    if (file_exists($filePath)) {
        return response()->download($filePath);
    }

    return redirect()->back()->with('error', 'File tidak ditemukan.');
}

public function destroy($id)
{
    $nilai = Nilai::findOrFail($id);

    try {
        $nilai->delete(); // Hapus data
        return redirect()->back()->with('success', 'Data nilai berhasil dihapus.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data.');
    }
}





    
}
