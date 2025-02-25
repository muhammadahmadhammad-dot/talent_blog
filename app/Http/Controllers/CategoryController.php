<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use Illuminate\Support\Facades\Validator;
use illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::latest()->paginate(5);
        return view('dashboard.category.index', compact('categories'));
    }

    public function store(StoreCategoryRequest $request)
    {
        $request->validated();

        // generate slug and merge in request 
        $request->merge(['slug' => Str::slug($request->name)]);
        // validate slug it must be unique
        $validated = Validator::make($request->all(), [
            'slug' => 'unique:categories,slug',
        ]);
        // if its not unique than we add some counting
        if ($validated->fails()) {
            $request->merge(['slug' => Str::slug($request->name) . '-' . strtotime(now())]);
        }
        try {
            Category::create([
                'name' => $request->name,
                'slug' => $request->slug,
            ]);
            return to_route('category.index')->with('success', 'Category created successfully.');
        } catch (\Exception $exp) {
            return to_route('category.index')->with('error', 'Something Thing Wrong. Error : ' . $exp);
        }
    }
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $validated = $request->validated();
        try {
            $category->update($validated);
            return to_route('category.index')->with('success', 'Category updated successfully.');
        } catch (\Exception $exp) {
            return to_route('category.index')->with('error', 'Something Thing Wrong. Error : ' . $exp);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $name = $category->name;
        try {
            $category->delete();
            return to_route('category.index')->with('success', "Category \" {$name} \" deleted successfully.");
        } catch (\Exception $exp) {
            return to_route('category.index')->with('error', 'Something Thing Wrong. Error : ' . $exp);
        }
        
    }
}
