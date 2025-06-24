<?php

namespace Database\Seeders;

use App\Models\Progres;
use App\Models\User;
use App\Models\Kegiatan;
use Illuminate\Database\Seeder;

class ProgresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (User::count() === 0) { User::factory()->create(); }
        if (Kegiatan::count() === 0) { Kegiatan::factory()->create(); }
        Progres::factory(40)->create();
    }
}