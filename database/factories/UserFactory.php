<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    public function definition(): array
    {
        $password_hash = Hash::make(env('DEMO_ACCOUNT_PASSWORD', 'test1234'));
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(), // baikin agar hasilnya jadi @stundet.itk.ac.id
            'password' => $password_hash, // Hash default password
            'role' => 'mahasiswa',
            'nim_nip' => fake()->unique()->numerify('1025####'),
            'email_verified_at' => now(),
        ];
    }

    public function admin(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'admin',
            'nim_nip' => null,
        ]);
    }

    public function dosen(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'dosen',
            'nim_nip' => fake()->unique()->numerify('1985010120201210##'),
        ]);
    }
}