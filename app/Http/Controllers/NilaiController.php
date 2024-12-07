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
         $users = User::where('rul', 'PESERTA')
         ->paginate(10)
         ->withQueryString();
    // dd($nilais); // Untuk melihat data yang diambil
    return view('pages.nilai.index', compact('users'));
    }

// return view('pages.nilai.index', compact('nilais'));
public function edit(Request $request)
{
    // $user = \App\Models\User::findOrFail($id);
    return view('pages.nilai.edit')->with('nilai', $request);
    
}
       
    

    public function update(Request $request, $id)
    {
        $request->validate([
            'kehadiran' => 'nullable|integer',
            'kompetensi' => 'nullable|string',
            'skill' => 'nullable|string',
            'status' => 'nullable|string',
        ]);
    
        // Cari data nilai berdasarkan ID
        $nilai = nilai::findOrFail($id);
    
        // Update data
        $nilai->update([
            'kehadiran' => $request->input('kehadiran'),
            'kompetensi' => $request->input('kompetensi'),
            'skill' => $request->input('skill'),
            'status' => $request->input('status'),
        ]);
    
        return redirect()->route('nilai.index')->with('success', 'Data nilai berhasil diperbarui.');
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

public function destroy(nilai $users)
{
   
    $users->delete(); // Hapus data

    return redirect()->route('nilai.index')->with('success', 'Data berhasil dihapus.');
}

public function model(array $row)
{
    dd($row); // Lihat data yang diterima dari Excel
}


    
}
