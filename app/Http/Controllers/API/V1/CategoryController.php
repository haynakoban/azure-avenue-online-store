<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index($category)
    {
        $products = Category::where('name', $category)->first()->products()->paginate(24);
        
        return view('shop.categories.index', compact('products'));
    }
}
