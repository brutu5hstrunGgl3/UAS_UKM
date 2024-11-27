<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

 

    protected $fillable = [
        
        'name',
        'no_telp',
        'email',
        'jenis_paket',
        'harga',
        'tanggal_pembayaran',
        'status',
        'struk',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id'); // Menggunakan user_id sebagai foreign key
    }

//   public function user()
//   {
//       return $this->belongsTo(User::class);
//   }
}
