<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use App\Models\Attendance;
use App\Http\Requests\StoreAttendance;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

         $attendances= DB::table('attendances')
        ->when($request->input('name'), function ($query, $name) {
            return $query->where('name', 'like', '%' . $name . '%');
        })
        //->select('id', 'name', 'email', 'phone', DB::raw('DATE_FORMAT(created_at, "%d %M %Y") as created_at'))
        ->orderBy('created_at', 'desc')
        ->paginate(10);


        return view('pages.Absensi.index' , compact('attendances'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAttendance $request)
{
    // Validasi input dari peserta
    $request->validate([
        'status' => 'required|in:hadir,tidak hadir', // status harus salah satu dari ini
    ]);

    // Cek apakah peserta sudah absen hari ini
    $attendanceToday = Attendance::where('name', Auth::user()->name)
                                ->whereDate('jadwal', now()->toDateString())
                                ->first();

    if ($attendanceToday) {
        return redirect()->route('absensi.index')->with('success', 'Data anda berhasil di edit');
    }

    // Simpan absensi berdasarkan nama peserta
    Attendance::create([
        'name' => Auth::user()->name, // Simpan nama peserta
        'status' => $request->status, // Status absensi
        'jadwal' => now(), // Waktu absensi
    ]);

    return redirect()->route('absensi.index')->with('success', 'Anda telah melakukan absensi');
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
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
    public function destroy(string $id)
    {
        //
    }
}
