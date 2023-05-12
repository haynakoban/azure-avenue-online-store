<?php

namespace App\Http\Controllers\API\V1;

use App\Filters\V1\CategoryFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\BulkStoreCategoryRequest;
use App\Http\Requests\V1\StoreCategoryRequest;
use App\Http\Requests\V1\UpdateCategoryRequest;
use App\Http\Resources\V1\CategoryCollection;
use App\Http\Resources\V1\CategoryResource;
use App\Models\Category;
use Carbon\Carbon;
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

    public function store(StoreCategoryRequest $request)
    {
        return new CategoryResource(Category::create($request->all()));
    }

    public function bulkStore(BulkStoreCategoryRequest $request)
    {
        $bulk = collect($request->all());

        $now = Carbon::now();
        $bulk = $bulk->map(function ($record) use ($now) {
            $record['created_at'] = $now;
            $record['updated_at'] = $now;
            return $record;
        });

        Category::insert($bulk->toArray());
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update($request->all());
    }
}
