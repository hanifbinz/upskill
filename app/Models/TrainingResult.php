<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'recommended_training',
        'explanation', // WAJIB DITAMBAHKAN AGAR ALASAN TERSIMPAN
        'status',
        'spv_notes',
    ];

    // Relasi balik ke tabel User (Karyawan)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}