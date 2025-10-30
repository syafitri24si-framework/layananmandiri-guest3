<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warga extends Model
{
    use HasFactory;

    protected $table = 'warga'; // Nama tabel

    protected $primaryKey = 'warga_id'; // Primary Key

    // Jika kolom primary key bukan 'id' dan tidak bertipe UUID, biarkan increment true
    public $incrementing = true;

    // Tipe data dari primary key
    protected $keyType = 'int';

    // Kolom yang boleh diisi (mass assignment)
    protected $fillable = [
        'no_ktp',
        'nama',
        'jenis_kelamin',
        'agama',
        'pekerjaan',
        'telp',
        'email',
    ];

    // Jika ingin menonaktifkan timestamps (created_at, updated_at), ubah ke false
    public $timestamps = true;

    /**
     * Contoh accessor untuk format tampilan nama.
     * (Opsional)
     */
    public function getNamaAttribute($value)
    {
        return ucwords($value); // otomatis kapital setiap kata
    }
}
