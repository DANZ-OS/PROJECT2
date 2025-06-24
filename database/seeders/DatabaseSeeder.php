<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

// Impor semua kelas Seeder yang akan dipanggil
use Database\Seeders\UserSeeder;
use Database\Seeders\MataKuliahSeeder;
use Database\Seeders\ProfilPenggunaSeeder;
use Database\Seeders\KegiatanSeeder;
use Database\Seeders\JadwalSeeder;
use Database\Seeders\ProgresSeeder;
use Database\Seeders\RiwayatKegiatanSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            MataKuliahSeeder::class,
            ProfilPenggunaSeeder::class,
            KegiatanSeeder::class,
            JadwalSeeder::class,
            ProgresSeeder::class,
            RiwayatKegiatanSeeder::class,
        ]);
    }
}