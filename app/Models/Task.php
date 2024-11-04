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
        'is_completed',
    ];

    protected $casts = [
        'tanggal' => 'datetime', // otomatis mengonversi ke objek Carbon
    ];
}
