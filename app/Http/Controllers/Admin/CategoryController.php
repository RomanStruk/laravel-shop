<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $categories = Category::allRelations(false)->select(['id', 'slug', 'name', 'parent_id', 'description'])->paginate();
        return view('admin.category.index')
            ->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('admin.category.create', [
            'category' => [],
            'categories' => Category::allRelations()->get(),
            'delimiter' => ''
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryRequest $request
     * @return RedirectResponse
     */
    public function store(CategoryRequest $request)
    {
        $category = new Category($request->validated());
        $category->save();
        return redirect()
            ->route('admin.category.edit', ['category' => $category->id])
            ->with('success', __('category.save'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $category
     * @return Factory|View
     */
    public function edit(int $category)
    {
        return view('admin.category.edit', [
            'category' => Category::getCategoryByIdOrSlug($category)->get()->first(),
            'categories' => Category::allRelations()->get(),
            'delimiter' => ''
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryRequest $request
     * @param integer $category
     * @return RedirectResponse
     */
    public function update(CategoryRequest $request, $category)
    {
        $updateCategory = Category::findOrFail($category);
        $updateCategory->update($request->validated());
        return redirect()
            ->back()
            ->with('success', __('category.update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param integer $category
     * @return RedirectResponse
     */
    public function destroy($category)
    {
        Category::destroy($category);
        return redirect()->back()->with('success', __('category.delete'));
    }
}
