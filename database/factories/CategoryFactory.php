<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = [
            'Home & Living', 'Electronics', 
            'Dresses', 'Jackets', 'Pants', 
            'Shorts', 'Health & Beauty',
            'Women’s Fashion', 'Toys & Hobbies',
            'Laptops', 'Smartphones', 'Keyboards',
            'Baby Gear', 'Nursery', 'Table Lamps',
            'Make-up', 'Hair Care', 'Skincare',
            'Personal Care', 'Medical Supplies',
            'Audio', 'Storage', 'Digital Cameras',
            'Gaming Console', 'Gadgets', 'Printers',
            'Computer Components', 'Wearable Technology',
            'Fan', 'Air Cooler', 'Air Conditioner',
            'Air Purifier', 'Air Fyers', 'Toasters'];

        return [
            'name' => fake()->unique()->randomElement($categories),
        ];
    }
}
