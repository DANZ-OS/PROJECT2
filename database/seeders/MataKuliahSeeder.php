<?php

namespace Database\Seeders;

use App\Models\MataKuliah;
use App\Models\User;
use Illuminate\Database\Seeder;

class MataKuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (User::count() === 0) { User::factory()->create(); }
        MataKuliah::factory(10)->create();
    }
}