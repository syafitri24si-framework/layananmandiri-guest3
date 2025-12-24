<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'profile_picture',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // ==================== METHOD UNTUK ROLE & AKSES ====================

    /**
     * Cek apakah user adalah Admin
     */
    public function isAdmin()
    {
        return $this->role === 'Admin';
    }

    /**
     * Cek apakah user adalah Warga
     */
    public function isWarga()
    {
        return $this->role === 'Warga';
    }

    /**
     * Get role label dengan badge HTML
     */
    public function getRoleBadgeAttribute()
    {
        if ($this->isAdmin()) {
            return '<span class="badge bg-danger">Admin</span>';
        } else {
            return '<span class="badge bg-primary">Warga</span>';
        }
    }

    /**
     * Get role icon
     */
    public function getRoleIconAttribute()
    {
        if ($this->isAdmin()) {
            return '<i class="lni lni-shield text-danger"></i>';
        } else {
            return '<i class="lni lni-user text-primary"></i>';
        }
    }

    // ==================== METHOD UNTUK RELASI DENGAN WARGA ====================

    /**
     * Get data warga berdasarkan email (tanpa relasi database)
     */
    public function dataWarga()
    {
        return Warga::where('email', $this->email)->first();
    }

    /**
     * Get warga_id (jika ada)
     */
    public function getWargaIdAttribute()
    {
        $warga = $this->dataWarga();
        return $warga ? $warga->warga_id : null;
    }

    /**
     * Get nama warga (jika ada, jika tidak pakai nama user)
     */
    public function getWargaNameAttribute()
    {
        $warga = $this->dataWarga();
        return $warga ? $warga->nama : $this->name;
    }

    /**
     * Check if user has warga data
     */
    public function hasWargaData()
    {
        return !is_null($this->dataWarga());
    }

    /**
     * Get permohonan surat milik warga ini (jika role warga)
     */
    public function permohonanSurat()
    {
        if (!$this->isWarga() || !$this->hasWargaData()) {
            return collect();
        }

        $warga = $this->dataWarga();
        return $warga->permohonanSurat ?? collect();
    }

    /**
     * Get berkas persyaratan milik warga ini (jika role warga)
     */
    public function berkasPersyaratan()
    {
        if (!$this->isWarga() || !$this->hasWargaData()) {
            return collect();
        }

        $warga = $this->dataWarga();
        $permohonanIds = $warga->permohonanSurat->pluck('permohonan_id');

        return \App\Models\BerkasPersyaratan::whereIn('permohonan_id', $permohonanIds)->get();
    }

    // ==================== METHOD UNTUK AUTHORIZATION ====================

    /**
     * Cek apakah user bisa mengakses data tertentu
     */
    public function canAccessWarga($wargaId)
    {
        if ($this->isAdmin()) {
            return true; // Admin bisa akses semua
        }

        if ($this->isWarga()) {
            return $this->warga_id == $wargaId; // Warga hanya bisa akses data sendiri
        }

        return false;
    }

    /**
     * Cek apakah user bisa mengakses permohonan surat tertentu
     */
    public function canAccessPermohonan($permohonanId)
    {
        if ($this->isAdmin()) {
            return true; // Admin bisa akses semua
        }

        if ($this->isWarga() && $this->hasWargaData()) {
            $warga = $this->dataWarga();
            $permohonan = \App\Models\PermohonanSurat::find($permohonanId);

            return $permohonan && $permohonan->warga_id == $warga->warga_id;
        }

        return false;
    }

    /**
     * Cek apakah user bisa mengakses berkas persyaratan tertentu
     */
    public function canAccessBerkas($berkasId)
    {
        if ($this->isAdmin()) {
            return true; // Admin bisa akses semua
        }

        if ($this->isWarga() && $this->hasWargaData()) {
            $berkas = \App\Models\BerkasPersyaratan::find($berkasId);
            if (!$berkas) return false;

            $permohonan = \App\Models\PermohonanSurat::find($berkas->permohonan_id);
            if (!$permohonan) return false;

            $warga = $this->dataWarga();
            return $permohonan->warga_id == $warga->warga_id;
        }

        return false;
    }

    // ==================== METHOD UNTUK DASHBOARD ====================

    /**
     * Get statistik untuk dashboard berdasarkan role
     */
    public function getDashboardStats()
    {
        $stats = [];

        if ($this->isAdmin()) {
            // Statistik untuk Admin
            $stats['total_warga'] = Warga::count();
            $stats['total_permohonan'] = \App\Models\PermohonanSurat::count();
            $stats['permohonan_diajukan'] = \App\Models\PermohonanSurat::where('status', 'diajukan')->count();
            $stats['permohonan_diproses'] = \App\Models\PermohonanSurat::where('status', 'diproses')->count();
            $stats['permohonan_selesai'] = \App\Models\PermohonanSurat::where('status', 'selesai')->count();
            $stats['jenis_surat'] = \App\Models\JenisSurat::count();

        } elseif ($this->isWarga() && $this->hasWargaData()) {
            // Statistik untuk Warga
            $warga = $this->dataWarga();
            $permohonan = $warga->permohonanSurat;

            $stats['total_permohonan'] = $permohonan->count();
            $stats['permohonan_diajukan'] = $permohonan->where('status', 'diajukan')->count();
            $stats['permohonan_diproses'] = $permohonan->where('status', 'diproses')->count();
            $stats['permohonan_selesai'] = $permohonan->where('status', 'selesai')->count();
            $stats['berkas_pending'] = $this->berkasPersyaratan()->where('valid', 'menunggu')->count();
            $stats['jenis_surat_tersedia'] = \App\Models\JenisSurat::count();
        }

        return $stats;
    }

    // ==================== METHOD LAMA (TETAP ADA) ====================

    public function scopeSearch($query, $request, array $columns)
    {
        if ($request->filled('search')) {
            $query->where(function($q) use ($request, $columns) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'LIKE', '%' . $request->search . '%');
                }
            });
        }
        return $query;
    }

    // ✅ METHOD UNTUK URL FOTO PROFIL DENGAN DEFAULT KEPALA+BADAN
    public function getProfilePictureUrlAttribute()
    {
        // Jika ada foto di database
        if ($this->profile_picture) {
            // Cek apakah ini URL eksternal
            if (str_starts_with($this->profile_picture, 'http')) {
                return $this->profile_picture;
            }

            // Cek file ada di storage
            if (Storage::disk('public')->exists($this->profile_picture)) {
                return Storage::url($this->profile_picture);
            }
        }

        // ✅ RETURN DEFAULT: KEPALA + BADAN SAJA (SVG Outline)
        $svg = '<?xml version="1.0" encoding="UTF-8"?>
        <svg xmlns="http://www.w3.org/2000/svg" width="200" height="200" viewBox="0 0 200 200">
            <!-- Background circle -->
            <circle cx="100" cy="100" r="95" fill="#f8f9fa" stroke="#dee2e6" stroke-width="2"/>

            <!-- Kepala (lingkaran) -->
            <circle cx="100" cy="70" r="25" fill="none" stroke="#6c757d" stroke-width="4"/>

            <!-- Badan (persegi panjang dengan lengkungan) -->
            <path d="M70,100 Q100,130 130,100" fill="none" stroke="#6c757d" stroke-width="4"/>

            <!-- Bahu kiri -->
            <line x1="75" y1="95" x2="85" y2="85" stroke="#6c757d" stroke-width="4"/>

            <!-- Bahu kanan -->
            <line x1="125" y1="85" x2="115" y2="95" stroke="#6c757d" stroke-width="4"/>
        </svg>';

        return 'data:image/svg+xml;base64,' . base64_encode($svg);
    }

    // ✅ METHOD UNTUK HAPUS FOTO DARI STORAGE
    public function deleteProfilePicture()
    {
        if ($this->profile_picture && Storage::disk('public')->exists($this->profile_picture)) {
            Storage::disk('public')->delete($this->profile_picture);
            return true;
        }
        return false;
    }

    // ✅ METHOD UNTUK CEK APAKAH PAKAI DEFAULT AVATAR
    public function getHasDefaultAvatarAttribute()
    {
        return !$this->profile_picture;
    }

    // ✅ METHOD UNTUK ICON DEFAULT
    public function getDefaultAvatarIconAttribute()
    {
        return '<i class="lni lni-user" style="font-size: 40px; color: #6c757d;"></i>';
    }
}
