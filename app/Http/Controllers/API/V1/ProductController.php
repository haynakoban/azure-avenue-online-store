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
        $queryItems = $filter->transform($request);

        if (count($queryItems) == 0) {
            return new ProductCollection(Product::paginate());
        } else {
            return new ProductCollection(Product::where($queryItems)->paginate());
        }
    }

    public function show(Product $product)
    {
        return new ProductResource($product);
    }
}
