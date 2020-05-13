<?php

namespace App\Http\Controllers\Admin;

use App\Attribute;
use App\Filter;
use App\Http\Controllers\Controller;
use App\Http\Requests\FilterRequest;
use App\Services\PaginateSession;
use Illuminate\Contracts\View\Factory;
use View;

class FilterController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param PaginateSession $paginateSession
     * @return Factory|View
     */
    public function index(PaginateSession $paginateSession)
    {
        $filters = Filter::allRelations()->paginate($paginateSession->getLimit());
        return view('admin.filter.index')->with('filters', $filters);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $filter = Filter::findOrFail($id);
        return view('admin.filter.show')->with('filter', $filter);
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(FilterRequest $request)
    {
        $filter = new Filter();
        $filter->name = $request->get('name');
        $filter->save();
        $attributes = [];
        foreach ($request->get('value') as $item){
            if (! empty($item))
                $attributes[] = new Attribute(['value' => $item]);
        }
        $filter->allAttributes()->saveMany($attributes);

        return redirect()->route('admin.filter.show', ['filter' => $filter->id])
            ->with('success', __('filter.save'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $filter = Filter::findOrFail($id);
        return view('admin.filter.edit')->with('filter', $filter);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param FilterRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(FilterRequest $request, $id)
    {
        $update = $request->validated();
        $filterModel = Filter::allRelations()->findOrFail($id);
        $filterModel->update(
            ['name' => $update['name']]
        );
        $filterModel->filterValues()->delete();

        $result = [];
        foreach ($update['value'] as $item){
            if (! empty($item))
                $result[] = new Attribute(['value' => $item]);
        }
        $filterModel->filterValues()->saveMany($result);

        return redirect()->back()->with('success', __('filter.update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        Filter::destroy($id);
        return redirect()->route('admin.filter.index')->with('success', __('filter.deleted'));
    }
}
