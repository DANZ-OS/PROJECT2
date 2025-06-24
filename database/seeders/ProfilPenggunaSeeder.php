<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\ProfilPengguna;
use Illuminate\Database\Seeder;

class ProfilPenggunaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        foreach ($users as $user) {
            if (!$user->profilPengguna()->exists()) {
                ProfilPengguna::factory()->create([
                    'user_id' => $user->id,
                    'nim' => 'NIM-' . str_pad($user->id, 5, '0', STR_PAD_LEFT),
                ]);
            }
        }
    }
}