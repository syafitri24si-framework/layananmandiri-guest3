<?php
// app/Models/RiwayatStatusSurat.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatStatusSurat extends Model
{
    use HasFactory;

    protected $table = 'riwayat_status_surat';
    protected $primaryKey = 'riwayat_id';

    // NONAKTIFKAN TIMESTAMPS OTOMATIS
    public $timestamps = false;

    // GUNAKAN 'waktu' SEBAGAI CREATED_AT (OPSIONAL)
    const CREATED_AT = 'waktu';
    const UPDATED_AT = null;

    protected $fillable = [
        'permohonan_id',
        'status',
        'petugas_warga_id',
        'waktu', // PASTIKAN ADA
        'keterangan'
    ];

    protected $casts = [
        'waktu' => 'datetime'
    ];

    // Relasi ke PermohonanSurat
    public function permohonan()
    {
        return $this->belongsTo(PermohonanSurat::class, 'permohonan_id', 'permohonan_id');
    }

    // Relasi ke Warga (petugas)
    public function petugas()
    {
        return $this->belongsTo(Warga::class, 'petugas_warga_id', 'warga_id');
    }
}
