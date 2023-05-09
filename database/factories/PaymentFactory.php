<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'payment_id' => fake()->randomElement(['PAYID-MRMKT7A4EK78293XG594394V', 'PAYID-MRMKYGI8SX902403V1203631', 'PAYID-MRMKYGI8SX902403V120377C']),
            'payer_id' => fake()->randomElement(['BY3AZVTREBSKQ', 'DU4NZVTREBSKQ', 'CZ2FZVTREBSKQ', 'HH56ZVTREBSKQ']),
            'payer_email' => fake()->randomElement(['sb-tm4wh25763700@personal.example.com', 'sb-147wh25763700@business.example.com', 'sb-cc4ab25763700@personal.example.com', 'sb-po4ce25763700@personal.example.com']),
            'amount' => fake()->randomFloat(2, 50, 9999),
            'payment_method' => fake()->creditCardType(),
            'payment_status' => fake()->randomElement(['approved', 'declined']),
        ];
    }
}
