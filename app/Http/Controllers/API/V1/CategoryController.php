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
        $queryItems = $filter->transform($request);

        if (count($queryItems) == 0) {
            return new CategoryCollection(Category::paginate());
        } else {
            $categories = Category::where($queryItems)->paginate();

            return new CategoryCollection($categories->appends($request->query()));
        }   
    }

    public function show(Category $category)
    {
        return new CategoryResource($category);
    }
}
