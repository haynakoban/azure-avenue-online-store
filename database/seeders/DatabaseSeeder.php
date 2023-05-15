<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed Users
        User::factory()->count(30)->create(['role_type' => 1]);
        User::factory()->count(50)->create(['role_type' => 2]);

        // Seed Categories
        $category = Category::factory()->count(20)->create();

        // Seed Products
        for ($i=0; $i < 250; $i++) { 
            $category = Category::inRandomOrder()->first();
            $user = User::where('role_type', 1)->inRandomOrder()->first();

            Product::factory()->create([
                'seller_id' => $user->id,
                'category_id' => $category->id,
            ]);
        }

        // Seed Orders
        for ($i=0; $i < 150; $i++) { 
            $buyer = User::where('role_type', 2)->inRandomOrder()->first();

            Order::factory()->create(['buyer_id' => $buyer->id]);
        }

        // Seed Payments
        Payment::factory()->count(150)->create();

        // Seed Carts
        for ($i=0; $i < 50; $i++) { 
            $user = User::where('role_type', 2)->inRandomOrder()->first();
            $product = Product::inRandomOrder()->first();

            Cart::factory()->create([
                'user_id' => $user->id,
                'product_id' => $product->id,
            ]);
        }
    }
}
