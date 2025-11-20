<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warga extends Model
{
    use HasFactory;

    protected $table = 'warga'; // Nama tabel

    protected $primaryKey = 'warga_id'; // Primary Key

    protected $fillable = [
        'no_ktp',
        'nama',
        'jenis_kelamin',
        'agama',
        'pekerjaan',
        'telp',
        'email',
    ];

    // Relasi ke permohonan_surat (1 warga -> banyak permohonan)
    public function permohonanSurat()
    {
        return $this->hasMany(PermohonanSurat::class, 'warga_id', 'warga_id');
    }

}
