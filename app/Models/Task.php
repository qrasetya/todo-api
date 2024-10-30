<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    
    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'nama_kegiatan',
        'tanggal',
        'deskripsi_kegiatan',
    ];

    protected $casts = [
        'tanggal' => 'datetime', // otomatis mengonversi ke objek Carbon
    ];
}
