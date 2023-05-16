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

        // Seed T-shirt Products
        $sellerTShirt = [
            'user' => User::where('role_type', 1)->inRandomOrder()->first(),
            'name' => [
                'Basics Cotton Oversized Shirt Trendy Earth Collection for Men Essential Tee 2022',
                'BOKU NO HERO T-shirt FOR MEN',
                'Round Neck T-shirt Essential Neutrals',
                'WMF OWN MADE Plain T-shirt',
            ],
            'description' => [
                'Oversize Tshirt for man Loose fit Tees Trendy comfortable top outfit casual for women t-shirt Asian Size',
                'Tshirt for man Loose fit Tees Trendy comfortable top outfit casual for women t-shirt Asian Size comfy breathable fashion Sale Free Shipping Pambahay Pantulog',
                'Collection t shirt for men comfortable Casual Wear outfits for men shirt Daily outfit comfy breathable tees fashion wears',
                'Plain Color Men Apparel T Shirt Mens',
            ],
            'imageUrl' => [
                'https://lzd-img-global.slatic.net/g/p/6ae821765bf05fcba08be7674966e5fb.png_720x720q80.png_.webp',
                'https://lzd-img-global.slatic.net/g/p/f32c062c43ae462aff5ff706951cccfd.jpg_720x720q80.jpg_.webp',
                'https://lzd-img-global.slatic.net/g/p/5edb4bd1c54638e8cd750232a9b4c8bb.jpg_720x720q80.jpg_.webp',
                'https://lzd-img-global.slatic.net/g/p/bef49c3adf393abbbf6a1e362b19c74b.jpg_720x720q80.jpg_.webp',
            ]
        ];
        for ($i=0; $i < 4; $i++) { 
            $category = Category::firstOrCreate(['name' => 'T-shirt']);

            Product::factory()->create([
                'seller_id' => $sellerTShirt['user']->id,
                'category_id' => $category->id,
                'name' => $sellerTShirt['name'][$i],
                'description' => $sellerTShirt['description'][$i],
                'image_url' => $sellerTShirt['imageUrl'][$i],
            ]);
        }

        // Seed Mobiles Products
        $sellerMobiles = [
            'user' => User::where('role_type', 1)->inRandomOrder()->first(),
            'name' => [
                'Apple iPhone 14 Pro Max',
                'OPPO F9',
                'VIVO Y51',
                'OPPO A83',
                'OPPO A53',
            ],
            'description' => [
                'Apple iPhone 14 Pro Max',
                'smartphone 8GB RAM+ 256GB ROM 6.3 inch Full screen 100% original legit cellphone',
                'BRANDNEW SMARTPHONE WITH COMPLETE PACKAGE COD!',
                'Smartphone 6GB + 128GB Cellphone 100% Original Brand New Facial recognition unlock 5.7 inch Full Screen AI HD Camera COD',
                'Original Phone 8+128GB New and Legit Cellphone 5000mAh Battery 1year warranty Gaming Phone Smartphone 6.5inch Full HD Screen Camera 17MP+16MP Fingerprint unlock Mobiles phone',
            ],
            'imageUrl' => [
                'https://lzd-img-global.slatic.net/g/p/7b4f962da75c1702037e3cc8ed11d49d.jpg_720x720q80.jpg_.webp',
                'https://lzd-img-global.slatic.net/g/p/49bfc93e385125f9093fcf28bc5be93e.jpg_720x720q80.jpg_.webp',
                'https://lzd-img-global.slatic.net/g/p/44a32c744583c9666b138c7b8a66d3b7.png_720x720q80.png_.webp',
                'https://lzd-img-global.slatic.net/g/p/c94372c3368d04fbcda07e198414fbde.jpg_720x720q80.jpg_.webp',
                'https://lzd-img-global.slatic.net/g/p/9b1b3fad9656301e5e8a22a2b6bdd677.jpg_720x720q80.jpg_.webp',
            ]
        ];
        for ($i=0; $i < 5; $i++) { 
            $category = Category::firstOrCreate(['name' => 'Smartphones']);

            Product::factory()->create([
                'seller_id' => $sellerMobiles['user']->id,
                'category_id' => $category->id,
                'name' => $sellerMobiles['name'][$i],
                'description' => $sellerMobiles['description'][$i],
                'image_url' => $sellerMobiles['imageUrl'][$i],
            ]);
        }

        // Seed Dresses Products
        $sellerDresses = [
            'user' => User::where('role_type', 1)->inRandomOrder()->first(),
            'name' => [
                'Ruffle Casual Dress',
                'Women Plus Size Dress',
                '4xl Daster dress',
                'Lapel Button Down Shirt Dress',
                'Loose Tunic Party Midi Dresses',
            ],
            'description' => [
                'Trending Best Seller Classy Elegant Blush Pink/Old Rose Short Sleeves Ruffle Casual Dress',
                'K.Store Korean Daster Sleepwear for Girl\'s Women Plus Size Dress (FREESIZE) new 2022 sale',
                '2023 New Fashion Plus size 4xl',
                'ZANZEA Korean Style Women Short Sleeve Midi Sundress',
                'ZANZEA Korean Style Women Floral Shirt Dress',
            ],
            'imageUrl' => [
                'https://lzd-img-global.slatic.net/g/p/60495db7d51d10584c49e233af377f95.jpg_720x720q80.jpg_.webp',
                'https://lzd-img-global.slatic.net/g/p/0230262fffc51e14c56e07fde59ffa58.jpg_720x720q80.jpg_.webp',
                'https://lzd-img-global.slatic.net/g/p/c02665cce36564957f8eb35fbbc424f6.jpg_720x720q80.jpg_.webp',
                'https://lzd-img-global.slatic.net/g/p/496497a904dc42e3f9d6cd337ff114e4.jpg_720x720q80.jpg_.webp',
                'https://lzd-img-global.slatic.net/g/p/3ba8120d8f7a022c707032eee265cb1a.jpg_720x720q80.jpg_.webp',
            ]
        ];
        for ($i=0; $i < 5; $i++) { 
            $category = Category::firstOrCreate(['name' => 'Dresses']);

            Product::factory()->create([
                'seller_id' => $sellerDresses['user']->id,
                'category_id' => $category->id,
                'name' => $sellerDresses['name'][$i],
                'description' => $sellerDresses['description'][$i],
                'image_url' => $sellerDresses['imageUrl'][$i],
            ]);
        }

        // Seed Jackets Products
        $sellerJackets = [
            'user' => User::where('role_type', 1)->inRandomOrder()->first(),
            'name' => [
                'Hoodie Jacket',
                'Unisex Plain Hoodie Jacket',
                'Oversep Jacket for Unisex',
                'Fashion High Quality Jacket',
                'Bone Korean Jersey Jacket',
                'Lightweight Jacket',
            ],
            'description' => [
                'Unisex on sale With Hood Korean Fashion may zipper',
                'Unisex Plain Hoodie Jacket with No zipper jacket',
                'Oversep Jacket for Unisex Plain Jacket Hoodies for Unisex',
                'HUILISHI Korean baseball uniform unisex',
                'Kinwoo T1070 Varsity Bomber Baseball Jacket Bone Korean Jersey Jacket For Men',
                'Lightweight Jacket',
            ],
            'imageUrl' => [
                'https://lzd-img-global.slatic.net/g/p/0bc247cc8acb3a384b89731d7efc5a24.png_720x720q80.png_.webp',
                'https://lzd-img-global.slatic.net/g/p/ee6e95fdb252bae61d4c403a5a71ff3d.jpg_720x720q80.jpg_.webp',
                'https://lzd-img-global.slatic.net/g/p/e63e5f9bb5ba1c739333b83e998bc787.jpg_720x720q80.jpg_.webp',
                'https://lzd-img-global.slatic.net/g/p/c98746312c18ff99e0a94470ca654119.jpg_720x720q80.jpg_.webp',
                'https://lzd-img-global.slatic.net/g/p/9979fee0537390b157a3356503d61636.jpg_720x720q80.jpg_.webp',
                'https://lzd-img-global.slatic.net/g/p/fc2c33a8166705f3e1e3c577cd281955.jpg_720x720q80.jpg_.webp',
            ]
        ];
        for ($i=0; $i < 6; $i++) { 
            $category = Category::firstOrCreate(['name' => 'Jackets']);

            Product::factory()->create([
                'seller_id' => $sellerJackets['user']->id,
                'category_id' => $category->id,
                'name' => $sellerJackets['name'][$i],
                'description' => $sellerJackets['description'][$i],
                'image_url' => $sellerJackets['imageUrl'][$i],
            ]);
        }

        // Seed Shorts Products
        $sellerShorts = [
            'user' => User::where('role_type', 1)->inRandomOrder()->first(),
            'name' => [
                'Design Taslan Shorts',
                'Pockets Short',
                'Mens Short with 2 pockets',
                'Comfortable Men\'s Shorts',
                'High Waist Trouser Shorts',
            ],
            'description' => [
                'New Design Taslan Shorts Quick-Drying For Men And Women JB17-KE',
                '4 Pockets Short For Men Plain Cotton JF15',
                'mens short with 2 pockets xl size jersey dri fit mens shorts design 30-42 inches waist. Elite',
                'W M F OWN MADE Korean fashion casual and comfortable men\'s shorts',
                'Mumu #JESSICA Plain Pocket High Waist Trouser Shorts with PLEATS and Two Side Pocket',
            ],
            'imageUrl' => [
                'https://lzd-img-global.slatic.net/g/p/01373451a6b238e470a022d8bc28bac2.jpg_720x720q80.jpg_.webp',
                'https://lzd-img-global.slatic.net/g/p/7bce7d4b0012a389403827cdcdffce55.jpg_720x720q80.jpg_.webp',
                'https://lzd-img-global.slatic.net/g/p/eafcbb2a5106a8f97035ec75554cbc9b.jpg_720x720q80.jpg_.webp',
                'https://lzd-img-global.slatic.net/g/p/4cb3f04a9f4db81aceb9d2db841c15c8.jpg_720x720q80.jpg_.webp',
                'https://lzd-img-global.slatic.net/g/p/a62c7a607fef42639e98ce4fd15cd0bd.jpg_720x720q80.jpg_.webp',
            ]
        ];
        for ($i=0; $i < 5; $i++) { 
            $category = Category::firstOrCreate(['name' => 'Shorts']);

            Product::factory()->create([
                'seller_id' => $sellerShorts['user']->id,
                'category_id' => $category->id,
                'name' => $sellerShorts['name'][$i],
                'description' => $sellerShorts['description'][$i],
                'image_url' => $sellerShorts['imageUrl'][$i],
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
