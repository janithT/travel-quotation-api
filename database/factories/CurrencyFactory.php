<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Currency>
 */
class CurrencyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = \App\Models\Currency::class;

    public function definition(): array
    {
        return [
            'currency_id' => $this->faker->currencyCode(),
            'fixed_rate' => $this->faker->randomFloat(2, 1, 5),
        ];
    }
}
