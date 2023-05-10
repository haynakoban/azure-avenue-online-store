<?php

namespace App\Http\Controllers\API\V1;

use App\Filters\V1\CategoryFilter;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CategoryCollection;
use App\Http\Resources\V1\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $filter  = new CategoryFilter();
        $filterItems = $filter->transform($request);

        $categories = Category::where($filterItems);

        $includeProducts = $request->query('includeProducts');

        if ($includeProducts) {
            $categories = $categories->with('products');
        }

        return new CategoryCollection($categories->paginate()->appends($request->query()));  
    }

    public function show(Category $category)
    {
        $includeProducts = request()->query('includeProducts');

        if ($includeProducts) {
            $category = $category->loadMissing('products');
        }

        return new CategoryResource($category);
    }
}
