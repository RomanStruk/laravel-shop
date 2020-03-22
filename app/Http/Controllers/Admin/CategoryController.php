<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Category\AdminFormCreateCategoryAction;
use App\Actions\Category\DeleteCategoryAction;
use App\Actions\Category\FormEditCategoryAction;
use App\Actions\Category\GetCategoryAction;
use App\Actions\Category\GetCategoryOrderByAction;
use App\Actions\Category\SaveCategoryAction;
use App\Actions\Category\UpdateCategoryAction;
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
     * @param GetCategoryOrderByAction $action
     * @return Factory|View
     */
    public function index(GetCategoryOrderByAction $action)
    {
//        dd($action->run(1));
        return view('admin.category.index')
            ->with('categories', $action->run());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param AdminFormCreateCategoryAction $action
     * @return Factory|View
     */
    public function create(AdminFormCreateCategoryAction $action)
    {
        return view('admin.category.create', $action->run());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryRequest $request
     * @param SaveCategoryAction $action
     * @return RedirectResponse
     */
    public function store(CategoryRequest $request, SaveCategoryAction $action)
    {
        $id = $action->run($request);
        return redirect()
            ->route('category.edit', ['category' => $id])
            ->with('success', __('category.save'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param FormEditCategoryAction $action
     * @param int $category
     * @return Factory|View
     */
    public function edit(FormEditCategoryAction $action, int $category)
    {
        return view('admin.category.edit', $action->run($category));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryRequest $request
     * @param UpdateCategoryAction $action
     * @param integer $category
     * @return RedirectResponse
     */
    public function update(CategoryRequest $request, UpdateCategoryAction $action, $category)
    {
        $action->run($request, $category);
        return redirect()
            ->back()
            ->with('success', __('category.update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DeleteCategoryAction $action
     * @param integer $category
     * @return RedirectResponse
     */
    public function destroy(DeleteCategoryAction $action, $category)
    {
        $action->run($category);
        return redirect()->back()->with('success', __('category.delete'));
    }
}
