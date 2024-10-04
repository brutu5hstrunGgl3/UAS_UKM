<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecturer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'position',
        'materi',
        'jadwal',
        'status',
        'updated_ad',
        'created_at',
        
        
    ];


}
