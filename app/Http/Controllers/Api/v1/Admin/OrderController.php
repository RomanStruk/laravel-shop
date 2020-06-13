<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\OrderAdvancedResource;
use App\Http\Resources\OrderSimpleResource;
use App\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter = $request->except('limit');
        $filter['date-desc'] = 'true';
        $orders = Order::filter($filter)->allRelations()->paginate($request->limit);
        return OrderSimpleResource::collection($orders)
            ->additional([
                'message' => 'Retrieve Data is Successfully',
                'success' => true
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return OrderAdvancedResource
     */
    public function show($id)
    {
        $order = Order::allRelations()->withTrashed()->findOrFail($id);
        return (new OrderAdvancedResource($order))->additional([
            'message' => 'Retrieve Data is Successfully',
            'success' => true
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
