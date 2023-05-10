<?php

namespace App\Http\Controllers\API\V1;

use App\Filters\V1\ProductFilter;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ProductCollection;
use App\Http\Resources\V1\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $filter  = new ProductFilter();
        $filterItems = $filter->transform($request);

        $products = Product::where($filterItems);

        $includeCarts = $request->query('includeCarts');
        $includeCategory = $request->query('includeCategory');
        $includeUser = $request->query('includeUser');

        if ($includeCarts) {
            $products = $products->with('carts');
        }
        if ($includeCategory) {
            $products = $products->with('category');
        }
        if ($includeUser) {
            $products = $products->with('user');
        }

        return new ProductCollection($products->paginate()->appends($request->query()));
    }

    public function show(Product $product)
    {
        $includeCarts = request()->query('includeCarts');
        $includeCategory = request()->query('includeCategory');
        $includeUser = request()->query('includeUser');

        if ($includeCarts) {
            $product = $product->loadMissing('carts');
        }
        if ($includeCategory) {
            $product = $product->loadMissing('category');
        }
        if ($includeUser) {
            $product = $product->loadMissing('user');
        }

        return new ProductResource($product);
    }
}
