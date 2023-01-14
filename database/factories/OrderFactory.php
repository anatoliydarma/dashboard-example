<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'option' => 'order',
            'user_id' => 1,
            'date' => $this->faker->dateTimeBetween('-12 months', '+12 months')->format('Y-m-d'),
            'time' => $this->faker->randomElement(['10:00:00', '11:30:00', '13:00:00', '14:30:00']),
            'adult' => $this->faker->randomNumber(2),
            'child' => $this->faker->randomNumber(2),
            'cost' => $this->faker->randomNumber(2, true),
            'note' => $this->faker->word(),
        ];
    }
}
