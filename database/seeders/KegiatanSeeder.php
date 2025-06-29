<?php

namespace Database\Seeders;

use App\Models\Kegiatan;
use App\Models\MataKuliah;
use App\Models\User;
use Illuminate\Database\Seeder;

class KegiatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan ada pengguna dan mata kuliah yang tersedia
        $user = User::first(); // Ambil pengguna pertama
        $mataKuliah = MataKuliah::first(); // Ambil mata kuliah pertama

        // Jika tidak ada pengguna atau mata kuliah, buat satu
        if (!$user) {
            $user = User::create([
                'name' => 'User  Default',
                'email' => 'user@example.com',
                'password' => bcrypt('password'), // Ganti dengan hash password yang sesuai
            ]);
        }

        if (!$mataKuliah) {
            $mataKuliah = MataKuliah::create([
                'nama' => 'Mata Kuliah Default',
                'deskripsi' => 'Deskripsi mata kuliah default',
            ]);
        }

        // Menambahkan data ke tabel kegiatan
        Kegiatan::insert([
            [
                'user_id' => $user->id,
                'nama' => 'Membuat ppt',
                'deskripsi' => 'Mata kuliah pemrograman web 2 tentang filament',
                'jenis' => 'presentasi',
                'deadline' => '2025-06-30 00:00:00',
                'prioritas' => 'rendah',
                'estimasi_jam' => 2,
                'status' => 'Sedang Berjalan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $user->id,
                'nama' => 'Tugas Matematika',
                'deskripsi' => 'Mengerjakan soal latihan dari buku',
                'jenis' => 'tugas',
                'deadline' => '2025-07-01 00:00:00',
                'prioritas' => 'tinggi',
                'estimasi_jam' => 3,
                'status' => 'Belum Dimulai',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Tambahkan lebih banyak data sesuai kebutuhan
        ]);
    }
}
