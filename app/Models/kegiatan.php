<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    // Tambahkan baris ini untuk mendefinisikan nama tabel secara eksplisit
    protected $table = 'kegiatan';

    // Define your existing constants here if they are not already
    const JENIS_OPTIONS = [
        'proyek' => 'Proyek',
        'kuis' => 'Kuis',
        'presentasi' => 'Presentasi',
        'nyatet materi' => 'Nyatet Materi',
        'UTS' => 'UTS',
        'UAS' => 'UAS',
    ];

    const PRIORITAS_OPTIONS = [
        'Rendah' => 'Rendah',
        'Sedang' => 'Sedang',
        'Tinggi' => 'Tinggi',
        'Sangat Tinggi' => 'Sangat Tinggi',
    ];

    const STATUS_OPTIONS = [
        'Belum Dimulai' => 'Belum Dimulai',
        'Sedang Berjalan' => 'Sedang Berjalan',
        'Selesai' => 'Selesai',
        'Tertunda' => 'Tertunda',
    ];

    protected $fillable = [
        'nama',
        'deskripsi',
        'jenis',
        'deadline',
        'prioritas',
        'estimasi_jam',
        'status',
        'mata_kuliah_id',
        'user_id',
    ];

    /**
     * Get the mata kuliah that owns the Kegiatan.
     */
    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'mata_kuliah_id');
    }
}