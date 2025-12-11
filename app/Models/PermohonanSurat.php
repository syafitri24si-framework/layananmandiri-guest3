<?php
// app/Models/PermohonanSurat.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PermohonanSurat extends Model
{
    use HasFactory;

    protected $table = 'permohonan_surat';
    protected $primaryKey = 'permohonan_id';

    protected $fillable = [
        'nomor_permohonan',
        'warga_id',
        'jenis_id',
        'tanggal_pengajuan',
        'status',
        'catatan',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'tanggal_pengajuan' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Generate nomor permohonan otomatis
     */
    public static function generateNomorPermohonan()
    {
        $prefix = 'PS';
        $date = date('Ym');
        $lastNumber = self::where('nomor_permohonan', 'like', $prefix . $date . '%')
            ->orderBy('nomor_permohonan', 'desc')
            ->first();

        if ($lastNumber) {
            $lastNumber = (int) substr($lastNumber->nomor_permohonan, -4);
            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '0001';
        }

        return $prefix . $date . $newNumber;
    }

    /**
     * RELASI: ke model Warga
     */
    public function warga()
    {
        return $this->belongsTo(Warga::class, 'warga_id', 'warga_id');
    }

    /**
     * RELASI: ke model JenisSurat
     */
    public function jenisSurat()
    {
        return $this->belongsTo(JenisSurat::class, 'jenis_id', 'jenis_id');
    }

    /**
     * RELASI: ke model Media (berkas upload)
     */
    public function mediaFiles()
    {
        return $this->hasMany(Media::class, 'ref_id', 'permohonan_id')
            ->where('ref_table', 'permohonan_surat')
            ->orderBy('sort_order', 'asc');
    }

    /**
     * RELASI: ke model BerkasPersyaratan
     */
    public function berkasPersyaratan()
    {
        return $this->hasMany(BerkasPersyaratan::class, 'permohonan_id', 'permohonan_id');
    }

    /**
     * RELASI: ke model RiwayatStatusSurat
     */
    public function riwayatStatus()
    {
        return $this->hasMany(RiwayatStatusSurat::class, 'permohonan_id', 'permohonan_id');
    }

    /**
     * Tambah riwayat status baru (UNTUK CREATE)
     */
    public function tambahRiwayatStatus($status, $petugasId = null, $keterangan = '')
    {
        return RiwayatStatusSurat::create([
            'permohonan_id' => $this->permohonan_id,
            'status' => $status,
            'petugas_warga_id' => $petugasId,
            'keterangan' => $keterangan,
            'waktu' => now() // PAKAI KOLOM 'waktu' BUKAN 'created_at'
        ]);
    }

    /**
     * Update status dan buat riwayat (UNTUK UPDATE)
     */
    public function updateStatus($status, $petugasId = null, $keterangan = '')
    {
        // Update status permohonan
        $this->status = $status;
        $this->save();

        // Buat riwayat
        return $this->tambahRiwayatStatus($status, $petugasId, $keterangan);
    }

    /**
     * Scope untuk permohonan aktif
     */
    public function scopeAktif($query)
    {
        return $query->whereIn('status', ['diajukan', 'diproses']);
    }

    /**
     * Scope untuk permohonan selesai
     */
    public function scopeSelesai($query)
    {
        return $query->whereIn('status', ['selesai', 'ditolak']);
    }

    /**
     * Cek apakah permohonan bisa diedit
     */
    public function getBisaDieditAttribute()
    {
        return in_array($this->status, ['diajukan', 'diproses']);
    }

    /**
     * Get status warna (untuk badge/tampilan)
     */
    public function getStatusWarnaAttribute()
    {
        $warna = [
            'diajukan' => 'info',
            'diproses' => 'warning',
            'selesai' => 'success',
            'ditolak' => 'danger'
        ];

        return $warna[$this->status] ?? 'secondary';
    }

    /**
     * Get status text (format tampilan)
     */
    public function getStatusTextAttribute()
    {
        $text = [
            'diajukan' => 'Diajukan',
            'diproses' => 'Diproses',
            'selesai' => 'Selesai',
            'ditolak' => 'Ditolak'
        ];

        return $text[$this->status] ?? 'Unknown';
    }

    /**
     * Get tanggal pengajuan format Indonesia
     */
    public function getTanggalPengajuanFormattedAttribute()
    {
        return $this->tanggal_pengajuan ?
            $this->tanggal_pengajuan->translatedFormat('d F Y') :
            '-';
    }

    /**
     * Get semua berkas yang sudah diupload
     */
    public function getSemuaBerkasAttribute()
    {
        $berkas = [];

        // Berkas dari media files
        foreach ($this->mediaFiles as $media) {
            $berkas[] = [
                'nama' => $media->caption ?? $media->file_name,
                'file' => $media->file_name,
                'tipe' => 'upload'
            ];
        }

        // Berkas persyaratan
        foreach ($this->berkasPersyaratan as $persyaratan) {
            $berkas[] = [
                'nama' => $persyaratan->nama_berkas,
                'status' => $persyaratan->valid,
                'tipe' => 'syarat'
            ];
        }

        return $berkas;
    }

    /**
     * Get riwayat status terakhir
     */
    public function getStatusTerakhirAttribute()
    {
        return $this->riwayatStatus()
            ->orderBy('waktu', 'desc')
            ->first();
    }

    /**
     * Get waktu sejak pengajuan
     */
    public function getWaktuSejakAttribute()
    {
        if (!$this->created_at) return '-';

        $diff = $this->created_at->diff(now());

        if ($diff->d > 0) {
            return $diff->d . ' hari';
        } elseif ($diff->h > 0) {
            return $diff->h . ' jam';
        } elseif ($diff->i > 0) {
            return $diff->i . ' menit';
        } else {
            return 'Baru saja';
        }
    }
}
