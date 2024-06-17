<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::where('user_id', auth()->id())->orderByDesc('id')->paginate(8);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $validated = $request->validated();

        $validated['slug'] = Str::slug($validated['name'], '-');
        $validated['user_id'] = auth()->id();
        //dd($validated);
        Category::create($validated);
        return to_route('admin.categories.index')->with('message', 'Congratulation Category added Correctly!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        if ($category->user_id != auth()->id()) {
            abort(403, "You Can'T Edit Categories that are NOT Yours!");
        }
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $validated = $request->validated();

        $validated['slug'] = Str::slug($validated['name'], '-');

        $category->update($validated);
        return to_route('admin.categories.index')->with('message', 'Congratulation Category updated Correctly!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if ($category->user_id != auth()->id()) {
            abort(403, "You Can'T Delete Categories that are NOT Yours!");
        }
        $category->delete();
        return to_route('admin.categories.index')->with('message', 'Congratulation Category deleted correctly!');
    }
}
