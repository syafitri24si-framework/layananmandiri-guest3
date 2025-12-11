<?php
// app/Models/BerkasPersyaratan.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BerkasPersyaratan extends Model
{
    use HasFactory;

    protected $table = 'berkas_persyaratan';
    protected $primaryKey = 'berkas_id';

    protected $fillable = [
        'permohonan_id',
        'nama_berkas',
        'valid'
    ];

    // Relasi ke PermohonanSurat
    public function permohonan()
    {
        return $this->belongsTo(PermohonanSurat::class, 'permohonan_id', 'permohonan_id');
    }
}
