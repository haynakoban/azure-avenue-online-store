<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $categories = Category::inRandomOrder()->paginate(16);
        $just_for_you = Product::paginate(24);
        $customers_also_purchased = Product::inRandomOrder()->paginate(24);

        return view('shop.products.index', compact('just_for_you', 'customers_also_purchased', 'categories'));
    }

    public function show(Product $product)
    {
        return view('shop.products.show', compact('product'));
    }
}
