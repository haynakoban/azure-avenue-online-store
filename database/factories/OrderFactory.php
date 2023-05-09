<?php

namespace Database\Factories;

use App\Models\User;
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
    public function definition(): array
    {
        return [
            'buyer_id' => User::factory(),
            'total_amount' => fake()->randomFloat(2, 50, 9999),
            'status' => fake()->randomElement(['pending', 'processing', 'completed', 'cancelled']),
            // 'shipping_address' => fake()->address(),
        ];
    }
}
