<?php

namespace App\Imports;

use App\Models\nilai;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
//log
use Illuminate\Support\Facades\Log;

class NilaiImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        // Log::info('Impor data: ', $row);
        return new nilai([
            'user_id' => Auth::user()->id, // ID pengguna yang terautentikasi
            'name' => Auth::user()->name, // Nama pengguna yang terautentikasi
            'kehadiran' => $row[1], // Misalkan kolom kehadiran ada di kolom kedua
            'kompetensi' => $row[2],
            'skill' => $row[3],
            'status' => $row[4], // Misalkan status ada di kolom keenam
        ]);
    }
}