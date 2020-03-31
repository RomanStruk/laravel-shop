<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Services\Data\Category\DeleteCategory;
use App\Services\Data\Category\GetCategories;
use App\Services\Data\Category\GetCategoryByIdOrSlug;
use App\Services\Data\Category\InsertCategory;
use App\Services\Data\Category\UpdateCategory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param GetCategories $getCategories
     * @return Factory|View
     */
    public function index(GetCategories $getCategories)
    {
        return view('admin.category.index')
            ->with('categories', $getCategories->handel(false));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param GetCategories $getCategories
     * @return Factory|View
     */
    public function create(GetCategories $getCategories)
    {
        return view('admin.category.create', [
            'category' => [],
            'categories' => $getCategories->handel(),
            'delimiter' => ''
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryRequest $request
     * @param InsertCategory $insertCategory
     * @return RedirectResponse
     */
    public function store(CategoryRequest $request, InsertCategory $insertCategory)
    {
        $category = $insertCategory->handel($request->validated());
        return redirect()
            ->route('admin.category.edit', ['category' => $category->id])
            ->with('success', __('category.save'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param GetCategories $getCategories
     * @param GetCategoryByIdOrSlug $getCategory
     * @param int $category
     * @return Factory|View
     */
    public function edit(GetCategories $getCategories, GetCategoryByIdOrSlug $getCategory, int $category)
    {
        return view('admin.category.edit', [
            'category' => $getCategory->handel($category),
            'categories' => $getCategories->handel(),
            'delimiter' => ''
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryRequest $request
     * @param UpdateCategory $updateCategory
     * @param integer $category
     * @return RedirectResponse
     */
    public function update(CategoryRequest $request, UpdateCategory $updateCategory, $category)
    {
        $updateCategory->handel($category, $request->validated());
        return redirect()
            ->back()
            ->with('success', __('category.update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DeleteCategory $deleteCategory
     * @param integer $category
     * @return RedirectResponse
     */
    public function destroy(DeleteCategory $deleteCategory, $category)
    {
        $deleteCategory->handel($category);
        return redirect()->back()->with('success', __('category.delete'));
    }
}
