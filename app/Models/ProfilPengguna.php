<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilPengguna extends Model
{
    use HasFactory;

    protected $table = 'profil_pengguna';

    protected $fillable = [
        'user_id',
        'nim',
        'jurusan',
        'fakultas',
        'foto_profil',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}