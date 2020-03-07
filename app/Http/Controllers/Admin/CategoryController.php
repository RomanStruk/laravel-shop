<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Services\CategoryService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param CategoryService $service
     * @return Factory|View
     */
    public function index(CategoryService $service)
    {
        return view('admin.category.index')
            ->with('categories', $service->categoriesOrderBy());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param CategoryService $service
     * @return Factory|View
     */
    public function create(CategoryService $service)
    {
        return view('admin.category.create')
            ->with('category', [])
            ->with('categories', $service->categories())
            ->with('delimiter' , '');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryRequest $request
     * @param CategoryService $service
     * @return RedirectResponse
     */
    public function store(CategoryRequest $request, CategoryService $service)
    {
        $id = $service->save($request);
        return redirect()
            ->route('category.edit', ['category' => $id])
            ->with('success', __('category.save'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @param CategoryService $service
     * @return Factory|View
     */
    public function edit(CategoryService $service, Category $category)
    {
        return view('admin.category.edit', [
            'category' => $category,
            'categories' => $service->categories(),
            'delimiter' => '']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryRequest $request
     * @param CategoryService $service
     * @param integer $category
     * @return RedirectResponse
     */
    public function update(CategoryRequest $request, CategoryService $service, $category)
    {
        $service->update($request, $category);
        return redirect()
            ->back()
            ->with('success', __('category.update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param CategoryService $service
     * @param integer $category
     * @return RedirectResponse
     */
    public function destroy(CategoryService $service, $category)
    {
        $service->delete($category);
        return redirect()->back()->with('success', __('category.delete'));
    }
}
