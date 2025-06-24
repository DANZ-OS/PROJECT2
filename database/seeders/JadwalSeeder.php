<?php

namespace Database\Seeders;

use App\Models\Jadwal;
use App\Models\User;
use App\Models\Kegiatan;
use Illuminate\Database\Seeder;

class JadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (User::count() === 0) { User::factory()->create(); }
        if (Kegiatan::count() === 0) { Kegiatan::factory()->create(); }
        Jadwal::factory(30)->create();
    }
}