<?php

namespace App\Http\Controllers\Admin;

use App\Filter;
use App\Http\Controllers\Controller;
use App\Http\Requests\FilterRequest;
use App\Services\Data\Filter\DeleteFilter;
use App\Services\Data\Filter\GetFilterById;
use App\Services\Data\Filter\GetFilters;
use App\Services\Data\Filter\InsertFilter;
use App\Services\Data\Filter\UpdateFilter;
use Illuminate\Contracts\View\Factory;
use View;

class FilterController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param GetFilters $filtersPagination
     * @return Factory|View
     */
    public function index(GetFilters $filtersPagination)
    {
        $filters = $filtersPagination->handel(true);
        return view('admin.filter.index')->with('filters', $filters);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.filter.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param FilterRequest $request
     * @param InsertFilter $insertGroupAttribute
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(FilterRequest $request, InsertFilter $insertGroupAttribute)
    {
        $insert = $insertGroupAttribute->handel($request->validated());
        return redirect()->route('admin.filter.show', ['filter' => $insert->id])
            ->with('success', __('filter.save'));
    }

    /**
     * Display the specified resource.
     *
     * @param GetFilterById $getFilterById
     * @param int $id
     * @return Factory|\Illuminate\View\View
     */
    public function show(GetFilterById $getFilterById, $id)
    {
        $filter = $getFilterById->handel($id);
        return view('admin.filter.show')->with('filter', $filter);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param GetFilterById $getFilterById
     * @param int $id
     * @return Factory|\Illuminate\View\View
     */
    public function edit(GetFilterById $getFilterById, $id)
    {
        $filter = $getFilterById->handel($id);
        return view('admin.filter.edit')->with('filter', $filter);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param FilterRequest $request
     * @param UpdateFilter $updateFilter
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(FilterRequest $request, UpdateFilter $updateFilter, $id)
    {
        $update = $request->validated();
        $updateFilter->handel($id, $update );
        return redirect()->back()->with('success', __('filter.update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @param DeleteFilter $deleteFilter
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id, DeleteFilter $deleteFilter)
    {
        $deleteFilter->handel($id);
        return redirect()->route('admin.filter.index')->with('success', __('filter.deleted'));
    }
}
