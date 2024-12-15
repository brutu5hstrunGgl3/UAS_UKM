<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\nilai;
use App\Http\Requests\StoreNilaiRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\PDF;
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
    $nilai = nilai::findOrFail($id);
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
    
        $nilai = nilai::findOrFail($id);
    
        // Jika ada file baru di-upload
      
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

    // Ambil nama user
    $user = User::findOrFail($request->user_id);
    
    // Tambahkan nama ke validated data
    $validatedData['name'] = $user->name;
    
    // Perbaiki logika upload file
    if ($request->hasFile('file_nilai')) {
        // Simpan file dengan nama unik
        $filePath = $request->file('file_nilai')->store('public/nilai');
        
        // Tambahkan path file ke validated data
        $validatedData['file_nilai'] = str_replace('public/', '', $filePath);
    }

    // Buat record nilai
    $nilai = new Nilai();
    $nilai->user_id = $request->user_id;
    $nilai->name = $user->name; // Tambahkan nama
    $nilai->kehadiran = $validatedData['kehadiran'];
    $nilai->kompetensi = $validatedData['kompetensi'];
    $nilai->skill = $validatedData['skill'];
    $nilai->status = $validatedData['status'];
    // Tambahkan file_nilai jika ada
    if (isset($validatedData['file_nilai'])) {
        $nilai->file_nilai = $validatedData['file_nilai'];
    }
    
    $nilai->save();
    return redirect()->route('nilai.index')->with('success', 'Data berhasil disimpan.');
}


public function downloadCertificate($id)
{
    // Ambil data nilai berdasarkan ID
    $nilai = nilai::findOrFail($id);

    // Path ke template sertifikat
    $templatePath = public_path('sertifikat/sertifikat.jpg');

    // Data yang akan ditampilkan di sertifikat
    $data = [
        'name' => $nilai->name, // Ambil nama dari database
        'date' => date('d F Y'), // Tanggal hari ini
        'kehadiran' => $nilai->kehadiran,
        'kompetensi' => $nilai->kompetensi,
        'skill' => $nilai->skill,
        'templatePath' => asset('sertifikat/sertifikat.jpg'), // URL gambar untuk dompdf
    ];

    // Buat file PDF dari view template
    $pdf = PDF::loadView('pages.nilai.template', compact('data'))
              ->setPaper('a4', 'landscape'); // Sesuaikan ukuran kertas dan orientasi

    // Generate output PDF
    return $pdf->download('certificate-' . $nilai->name . '.pdf');
}


public function destroy($id)
{
    $nilai = nilai::findOrFail($id);

    try {
        $nilai->delete(); // Hapus data
        return redirect()->back()->with('success', 'Data nilai berhasil dihapus.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data.');
    }
}
    
}
