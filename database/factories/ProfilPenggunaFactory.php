<?php

namespace Database\Factories;

use App\Models\ProfilPengguna;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProfilPengguna>
 */
class ProfilPenggunaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'nim' => $this->faker->unique()->numerify('##########'),
            'jurusan' => $this->faker->randomElement(['Teknik Informatika', 'Sistem Informasi', 'Manajemen', 'Akuntansi']),
            'fakultas' => $this->faker->randomElement(['Fakultas Ilmu Komputer', 'Fakultas Ekonomi dan Bisnis', 'Fakultas Teknik']),
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function (ProfilPengguna $profilPengguna) {
            // Optional: ensure unique user_id if factory is called multiple times without fresh database
            // This is generally handled by User::factory() ensuring unique users
        });
    }
}