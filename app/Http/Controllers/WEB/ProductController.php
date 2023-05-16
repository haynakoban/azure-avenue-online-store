<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $categories = Category::inRandomOrder()->limit(16)->get();
        $just_for_you = Product::orderByDesc('updated_at')->paginate(32);
        $customers_also_purchased = Product::inRandomOrder()->limit(16)->get();

        return view('shop.products.index', compact('just_for_you', 'customers_also_purchased', 'categories'));
    }

    public function show(Product $product)
    {
        return view('shop.products.show', compact('product'));
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        if ($keyword === '') {
            return view('shop.products.search', ['products' => null]);
        }

       
        $products = DB::table('products')
                ->join('categories', 'categories.id', '=', 'products.category_id')
                ->select('categories.name as category_name', 'products.*')
                ->when($keyword, function ($query, $keyword) {
                    return $query->where('products.name', 'like', '%' . $keyword . '%')
                        ->orWhere('products.description', 'like', '%' . $keyword . '%')
                        ->orWhere('categories.name', 'like', '%' . $keyword . '%');
                })->paginate(24);

        return view('shop.products.search', ['products' => $products]);
    }
}
