<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    //index
     
    public function index( Request $request)
    {

        $users = User::all();
        $pesertaUsers = $users->filter(function ($user) {
            return $user->role === 'peserta'; // Ganti 'role' sesuai dengan nama kolom role di tabel users
        });

        return view('pages.nilai.index', compact('pesertaUsers'));
       
    }
}
