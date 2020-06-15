<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\CategoryResource;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $categories = Category::allRelations(false)
            ->select(['id', 'slug', 'name', 'parent_id', 'description'])
            ->paginate($request->limit);

        return CategoryResource::collection($categories)
            ->additional([
                'message' => 'Retrieve Data is Successfully',
                'success' => true
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return CategoryResource
     */
    public function show($id)
    {
        return (new CategoryResource([]))->additional([
            'message' => 'Retrieve Data is Successfully',
            'success' => true
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
