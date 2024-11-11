<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayarans';

    protected $fillable = [
        
        'name',
        'no_telp',
        'email',
        'jenis_paket',
        'harga',
        'tanggal_pembayaran',
        'status',
        'struk',
    ];
}
