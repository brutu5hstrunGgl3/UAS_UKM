<?php

namespace App\Imports;

use App\Models\nilai;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\User;
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

        Log::info('Impor data: ', $row);
        return new nilai([
            'user_id' => $row[0], // Misalkan ID user ada di kolom pertama
            'name' => $row[1], // Misalkan nama ada di kolom kedua
            'kehadiran' => $row[2], // Misalkan kehadiran ada di kolom ketiga
            'kompetensi' => $row[3], // Misalkan kompetensi ada di kolom keempat
            'skill' => $row[4], // Misalkan skill ada di kolom kelima
            'status' => $row[5], // Misalkan status ada di kolom keenam
        ]);
    }
}