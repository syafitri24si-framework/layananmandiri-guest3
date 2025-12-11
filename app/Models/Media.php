<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $table = 'media';
    protected $primaryKey = 'media_id';

    protected $fillable = [
        'ref_table',
        'ref_id',
        'file_name',
        'caption',
        'mime_type',
        'sort_order',
    ];

    // TANPA RELATIONSHIP METHOD (sesuai instruksi dosen)
    // Cukup scope untuk query

    /**
     * Scope untuk mengambil media berdasarkan referensi
     */
    public function scopeByReference($query, $refTable, $refId)
    {
        return $query->where('ref_table', $refTable)
                     ->where('ref_id', $refId)
                     ->orderBy('sort_order', 'asc');
    }

    /**
     * Accessor untuk URL file
     */
    // App/Models/Media.php
public function getFileUrlAttribute()
{
    // Tentukan folder berdasarkan ref_table
    $folderMap = [
        'berkas_persyaratan' => 'uploads/berkas_persyaratan/',
        'permohonan_surat' => 'uploads/permohonan_surat/',
        'jenis_surat' => 'uploads/jenis_surat/',
        // tambahkan mapping untuk tabel lain
    ];

    $folder = $folderMap[$this->ref_table] ?? 'uploads/';

    return asset('storage/' . $folder . $this->file_name);
}

// Tambahkan juga method untuk path storage
public function getStoragePathAttribute()
{
    $folderMap = [
        'berkas_persyaratan' => 'uploads/berkas_persyaratan/',
        'permohonan_surat' => 'uploads/permohonan_surat/',
        'jenis_surat' => 'uploads/jenis_surat/',
    ];

    $folder = $folderMap[$this->ref_table] ?? 'uploads/';

    return storage_path('app/public/' . $folder . $this->file_name);
}
}
