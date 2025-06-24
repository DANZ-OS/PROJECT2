<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatKegiatan extends Model
{
    use HasFactory;

    protected $table = 'riwayat_kegiatan';

    protected $fillable = [
        'user_id',
        'kegiatan_id',
        'tanggal_selesai',
        'durasi_pengerjaan',
        'catatan',
    ];

    protected $casts = [
        'tanggal_selesai' => 'date',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class);
    }
}