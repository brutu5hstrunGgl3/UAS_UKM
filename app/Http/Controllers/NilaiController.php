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

    public function create(Request $request, $id)
    {
        $user = User::findOrFail($id);
        return view('pages.nilai.create', compact('user'));
    }
    

    public function store(Request $request)
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

    return redirect()->route('nilai.index')->with('success', 'Data berhasil disimpan.');
}

public function destroy(nilai $users)
{
   
    $users->delete(); // Hapus data

    return redirect()->route('nilai.index')->with('success', 'Data berhasil dihapus.');
}




    
}
