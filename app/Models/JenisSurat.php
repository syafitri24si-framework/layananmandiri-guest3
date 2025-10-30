<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisSurat extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'jenis_surat';

    // Nama kolom primary key
    protected $primaryKey = 'jenis_id';

    // Primary key bertipe integer dan auto increment
    public $incrementing = true;
    protected $keyType = 'int';

    // Kolom yang boleh diisi secara mass assignment
    protected $fillable = [
        'kode',
        'nama_jenis',
        'syarat_json',
    ];

    // Timestamps aktif (created_at & updated_at)
    public $timestamps = true;

    /**
     * Accessor untuk otomatis mengubah kolom syarat_json menjadi array saat diambil.
     */
    public function getSyaratJsonAttribute($value)
    {
        return $value ? json_decode($value, true) : [];
    }

    /**
     * Mutator untuk otomatis mengubah array/object menjadi JSON sebelum disimpan.
     */
    public function setSyaratJsonAttribute($value)
    {
        $this->attributes['syarat_json'] = is_array($value) ? json_encode($value) : $value;
    }
}
