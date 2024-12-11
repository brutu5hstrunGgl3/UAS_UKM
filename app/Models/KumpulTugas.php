<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KumpulTugas extends Model
{
    use HasFactory; 

    protected $table = 'kumpul_tugas';

    protected $fillable = [
        'name',
        'judul_tugas',
        'kelas',
        'file',
        'tanggal_upload',
    ];

  
}
