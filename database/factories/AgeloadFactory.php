<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ageload>
 */
class AgeloadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'min_age' => $this->faker->numberBetween(18, 60),
            'max_age' => $this->faker->numberBetween(61, 100),
            'load' => $this->faker->randomFloat(2, 0.1, 1.0),
        ];
    }
}
