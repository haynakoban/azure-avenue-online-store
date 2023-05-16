<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index($category)
    {
        $products = Category::where('name', $category)->first()->products()->paginate(24);
        $categories = Category::inRandomOrder()->whereNotIn('name', [$category])->limit(5)->get();
        
        return view('shop.categories.index', compact('products', 'categories'));
    }
}
