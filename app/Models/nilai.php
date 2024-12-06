<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nilai extends Model
{
    use HasFactory;

    protected $table = 'nilais';

    // Kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'user_id',   // ID pengguna yang berelasi
        'name',      // Nama peserta
        'kehadiran', // Status kehadiran
        'kompetensi',// Kompetensi yang dinilai
        'skill',     // Skill yang dimiliki
            // Nama file struk (jika ada)
    ];

}
