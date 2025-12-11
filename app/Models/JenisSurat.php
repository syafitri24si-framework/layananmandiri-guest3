<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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
    protected $keyType   = 'int';

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

    // Relasi ke permohonan_surat - SUDAH ADA (JANGAN DIUBAH)
    public function permohonanSurat()
    {
        return $this->hasMany(PermohonanSurat::class, 'jenis_id', 'jenis_id');
    }

    // ✅ TAMBAHKAN relasi ke media untuk jenis_surat
    public function mediaFiles()
    {
        return $this->hasMany(Media::class, 'ref_id', 'jenis_id')
                    ->where('ref_table', 'jenis_surat')
                    ->orderBy('sort_order');
    }

    // ✅ TAMBAHKAN method untuk upload template/file contoh
    public function uploadFile($file, $caption = null, $sortOrder = 0)
    {
        // File akan diupload nanti melalui controller
        // Method ini bisa digunakan untuk relasi

        return $this->mediaFiles()->create([
            'file_name' => $file->getClientOriginalName(), // Nanti digenerate unique name
            'caption' => $caption,
            'mime_type' => $file->getMimeType(),
            'sort_order' => $sortOrder,
            'ref_table' => 'jenis_surat',
            'ref_id' => $this->jenis_id
        ]);
    }

    // ✅ TAMBAHKAN method untuk mendapatkan template/file contoh
    public function getTemplateAttribute()
    {
        return $this->mediaFiles()
                    ->where('caption', 'like', '%template%')
                    ->orWhere('mime_type', 'application/pdf')
                    ->orWhere('mime_type', 'application/msword')
                    ->first();
    }

    // ✅ TAMBAHKAN method untuk mendapatkan contoh surat (gambar)
    public function getContohSuratAttribute()
    {
        return $this->mediaFiles()
                    ->where('mime_type', 'like', 'image/%')
                    ->where('caption', 'like', '%contoh%')
                    ->first();
    }

    // ✅ TAMBAHKAN method untuk menambah syarat ke JSON
    public function tambahSyarat($namaSyarat)
    {
        $syarat = $this->syarat_json;
        if (!in_array($namaSyarat, $syarat)) {
            $syarat[] = $namaSyarat;
            $this->syarat_json = $syarat;
            return $this->save();
        }
        return false;
    }

    // ✅ TAMBAHKAN method untuk menghapus syarat dari JSON
    public function hapusSyarat($namaSyarat)
    {
        $syarat = $this->syarat_json;
        $key = array_search($namaSyarat, $syarat);
        if ($key !== false) {
            unset($syarat[$key]);
            $this->syarat_json = array_values($syarat); // Reindex array
            return $this->save();
        }
        return false;
    }

    // ✅ TAMBAHKAN scope untuk pencarian
    public function scopeSearch($query, $keyword)
    {
        return $query->where('kode', 'like', "%{$keyword}%")
                     ->orWhere('nama_jenis', 'like', "%{$keyword}%");
    }

    // ✅ TAMBAHKAN method untuk mendapatkan daftar syarat sebagai string
    public function getDaftarSyaratStringAttribute()
    {
        return implode(', ', $this->syarat_json);
    }

    // Scope filter - SUDAH ADA (JANGAN DIUBAH)
    public function scopeFilter(Builder $query, $request, array $filterableColumns): Builder
    {
        foreach ($filterableColumns as $column) {
            if ($request->filled($column)) {
                $query->where($column, $request->input($column));
            }
        }
        return $query;
    }
}
