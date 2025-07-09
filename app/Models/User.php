<?php

namespace App\Models;

// --- TAMBAHKAN USE STATEMENT INI ---
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
// ------------------------------------

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// --- TAMBAHKAN "implements FilamentUser" DI SINI ---
class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'nim',
        'jurusan',
        'asal_kampus'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // --- TAMBAHKAN METHOD INI UNTUK FILAMENT ---
    public function canAccessPanel(Panel $panel): bool
    {
        // Logika untuk menentukan siapa yang boleh masuk ke panel admin.
        // Untuk saat ini, kita izinkan semua user yang terdaftar bisa masuk.
        return true;
    }
    // -------------------------------------------

    // Relationships
    public function mataKuliahs()
    {
        return $this->hasMany(MataKuliah::class);
    }

    public function kegiatans()
    {
        return $this->hasMany(Kegiatan::class);
    }

    protected static function boot()
    {
        parent::boot();
        
        static::deleting(function ($user) {
            // Hapus semua MataKuliah milik user
            $user->mataKuliahs()->delete();

            // Hapus semua Kegiatan milik user
            $user->kegiatans()->delete();
        });
    }
}