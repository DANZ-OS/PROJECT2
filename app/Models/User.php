<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
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

    // Relationships
    public function mataKuliahs()
    {
        return $this->hasMany(MataKuliah::class);
    }

    public function kegiatans()
    {
        return $this->hasMany(Kegiatan::class);
    }

    // --- HAPUS RELASI profilPenggunas() INI KARENA TABELNYA TIDAK ADA ---
    // public function profilPenggunas()
    // {
    //     return $this->hasOne(ProfilPengguna::class);
    // }

    protected static function boot()
    {
        parent::boot();
        
        static::deleting(function ($user) {
            // Hapus semua MataKuliah milik user
            $user->mataKuliahs()->delete();

            // Hapus semua Kegiatan milik user
            $user->kegiatans()->delete();

            // --- HAPUS PANGGILAN INI KARENA RELASI DAN TABELNYA TIDAK ADA ---
            // $user->profilPenggunas()->delete();
        });
    }
}