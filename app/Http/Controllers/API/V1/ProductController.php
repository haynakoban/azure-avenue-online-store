<?php

namespace App\Http\Controllers\API\V1;

use App\Filters\V1\ProductFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\BulkStoreProductRequest;
use App\Http\Requests\V1\DeleteRequest;
use App\Http\Requests\V1\StoreProductRequest;
use App\Http\Requests\V1\UpdateProductRequest;
use App\Http\Resources\V1\ProductCollection;
use App\Http\Resources\V1\ProductResource;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

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

    public function store(StoreProductRequest $request)
    {
        return new ProductResource(Product::create($request->all()));
    }

    public function bulkStore(BulkStoreProductRequest $request)
    {
        $bulk = collect($request->all())->map(function($arr, $key) {
            return Arr::except($arr, ['sellerId', 'categoryId', 'imageUrl']);
        });

        $now = Carbon::now();
        $bulk = $bulk->map(function ($record) use ($now) {
            $record['created_at'] = $now;
            $record['updated_at'] = $now;
            return $record;
        });

        Product::insert($bulk->toArray());
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->all());
    }

    public function destroy(DeleteRequest $request, $product)
    {
        $findProduct = Product::find($product);
        
        if (!$findProduct) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        $findProduct->delete();

        return response()->json(['message' => 'Product deleted successfully']);
    }
}
