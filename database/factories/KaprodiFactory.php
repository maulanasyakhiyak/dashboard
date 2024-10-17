<?php

namespace Database\Factories;

use App\Models\Kaprodi;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kaprodi>
 */
class KaprodiFactory extends Factory
{
    protected $model = Kaprodi::class;

    public function definition(): array
    {
        $user = User::factory()->create([
            'role' => 'kaprodi',
        ]);

        return [
            'id' => $this->faker->unique()->numberBetween(1000, 9999),
            'user_id' => $user->id,
            'kode_dosen' => $this->faker->unique()->numerify('DOS######'),
            'nip' => $this->faker->unique()->numerify('######'),
            'name' => $user->name,
        ];
    }
}
