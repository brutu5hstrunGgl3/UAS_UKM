<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\nilai;
use App\Http\Requests\StoreNilaiRequest;
use Illuminate\Support\Facades\DB;
use App\Imports\NilaiImport;
use Maatwebsite\Excel\Facades\Excel;

class NilaiController extends Controller
{
    //index
    public function index(Request $request)
    {
        // Ambil semua pengguna dari database
        $nilais = nilai::with('user')->orderBy('id', 'desc')->paginate(10);
       return view('pages.nilai.index', compact('nilais'));

       
    }

    public function create()
    {
        $users = User::where('rul', 'PESERTA')->get(); // Pastikan ini sesuai dengan kondisi yang Anda inginkan

        // Mengirim variabel $users ke view
        return view('pages.nilai.create', compact('users'));
    }


    public function store(StoreNilaiRequest $request)
{
    // Ambil data user berdasarkan user_id
    $user = User::findOrFail($request->input('user_id'));

    // Akses nama pengguna dari tabel users
    $name = $user->name;

    // Proses penyimpanan data
    $data = [
        'user_id' => $request->input('user_id'),
        'name' => $name, // Ambil dari tabel users
        'kehadiran' => $request->input('kehadiran'),
        'kompetensi' => $request->input('kompetensi'),
        'skill' => $request->input('skill'),
        'status' => $request->input('status'),
    ];

    // Simpan data ke tabel nilai (misalnya)
    nilai::create($data);

    return redirect()->route('nilai.create')->with('success', 'Data berhasil disimpan.');
}

public function import(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:xlsx,xls,csv',
    ]);

    Excel::import(new NilaiImport, $request->file('file'));

    return redirect()->route('nilai.index')->with('success', 'Data berhasil diimpor.');
}

public function show($id)
{ 
    
    $nilais = nilai::findOrFail($id); // Mengambil data nilai berdasarkan ID

    return view('nilai.index', compact('nilais')); // Mengirim data ke view
}

public function destroy($id)
{
    $nilai = nilai::findOrFail($id); // Cari data berdasarkan ID atau tampilkan error jika tidak ditemukan
    $nilai->delete(); // Hapus data

    return redirect()->route('nilai.index')->with('success', 'Data berhasil dihapus.');
}




    
}
