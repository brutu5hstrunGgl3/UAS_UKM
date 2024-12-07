<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    //index
    public function index(Request $request)
    {
        // Ambil semua pengguna dari database
        $users = User::when($request->input('name'), function ($query, $name) {
            return $query->where('name', 'like', '%' . $name . '%');
        })
        ->where('rul', 'PESERTA')
        ->select('name') // Hanya mengambil kolom 'name'
        ->orderBy('id', 'desc')
        ->paginate(10); // Mengatur pagination

        return view('pages.nilai.index', compact('users'));
    }
}
