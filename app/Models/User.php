<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
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
        // Ini adalah gambar SVG outline kepala dan badan tanpa kaki
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
