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
        if (User::count() === 0) { User::factory()->create(); }
        if (MataKuliah::count() === 0) { MataKuliah::factory()->create(); }
        Kegiatan::factory(20)->create();
    }
}