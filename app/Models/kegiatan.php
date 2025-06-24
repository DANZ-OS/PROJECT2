<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    protected $table = 'kegiatan';

    protected $fillable = [
        'user_id',
        'mata_kuliah_id',
        'nama',
        'deskripsi',
        'jenis',
        'deadline',
        'prioritas',
        'estimasi_jam',
        'status',
    ];

    protected $casts = [
        'deadline' => 'date',
    ];

    // Enums (konstanta untuk validasi dan tampilan)
    public const JENIS_OPTIONS = [
        'tugas' => 'Tugas',
        'proyek' => 'Proyek',
        'kuis' => 'Kuis',
        'presentasi' => 'Presentasi',
        'nyatet materi' => 'Nyatet Materi',
        'UTS' => 'UTS',
        'UAS' => 'UAS',
    ];

    public const PRIORITAS_OPTIONS = [
        'rendah' => 'Rendah',
        'sedang' => 'Sedang',
        'tinggi' => 'Tinggi',
    ];

    public const STATUS_OPTIONS = [
        'Belum Dimulai' => 'Belum Dimulai',
        'Sedang Berjalan' => 'Sedang Berjalan',
        'Selesai' => 'Selesai',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'mata_kuliah_id');
    }

    public function jadwals()
    {
        return $this->hasMany(Jadwal::class);
    }

    public function progres()
    {
        return $this->hasMany(Progres::class);
    }

    public function riwayatKegiatans()
    {
        return $this->hasMany(RiwayatKegiatan::class);
    }

    // Scopes
    public function scopeUrgent($query)
    {
        return $query->where('deadline', '>=', now())
                     ->where('deadline', '<=', now()->addDays(7))
                     ->where('status', '!=', 'Selesai')
                     ->orderBy('deadline');
    }

    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}