<?php

namespace Database\Factories;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MahasiswaFactory extends Factory
{
    protected $model = Mahasiswa::class;

    public function definition()
    {
        $user = User::factory()->create([
            'role' => 'mahasiswa'
        ]);

        return [
            'id' => $this->faker->unique()->numberBetween(1000, 9999),
            'user_id' => $user->id,
            'nim' => $this->faker->unique()->numerify('######'),
            'name' => $user->name,
            'tanggal_lahir' => $this->faker->dateTimeBetween('-20 years', '-18 years'),
            'tempat_lahir' => $this->faker->city(),
            'edit' => false,
        ];

    }
}
