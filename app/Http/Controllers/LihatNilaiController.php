<?php

namespace App\Http\Controllers;

use App\Models\LihatNilai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LihatNilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    // Jika admin atau pemateri, tampilkan semua data
    if (Auth::user()->rul == 'ADMIN' || Auth::user()->rul == 'PEMATERI') {
        $nilais = DB::table('nilais')
            ->when($request->input('name'), function ($query, $name) {
                return $query->where('name', 'like', '%' . $name . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(10);
    } else {
        // Untuk user biasa, hanya tampilkan data miliknya sendiri
        $nilais = DB::table('nilais')
            ->where('user_id', Auth::id())
            ->when($request->input('name'), function ($query, $name) {
                return $query->where('name', 'like', '%' . $name . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(10);
    }

    return view('pages.nilai.indexnilai', compact('nilais'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(LihatNilai $lihatNilai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LihatNilai $lihatNilai)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LihatNilai $lihatNilai)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LihatNilai $lihatNilai)
    {
        //
    }
}
