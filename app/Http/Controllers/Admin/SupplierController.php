<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SupplierRequest;
use App\Services\PaginateSession;
use App\Supplier;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param PaginateSession $paginateSession
     * @return View
     */
    public function index(PaginateSession $paginateSession)
    {
        $suppliers = Supplier::paginate($paginateSession->getLimit());
        return  view('admin.supplier.index')->with('suppliers', $suppliers);
    }

    /**
     * Display the specified resource.
     *
     * @param Supplier $supplier
     * @return View
     */
    public function show(Supplier $supplier)
    {
        $supplier->load('products');
//        dd($supplier);
        return view('admin.supplier.show')->with('supplier', $supplier);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return  view('admin.supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SupplierRequest $request
     * @return RedirectResponse
     */
    public function store(SupplierRequest $request)
    {
        $supplier = new Supplier($request->supplierFillData());
        $supplier->save();
        return redirect()->route('admin.supplier.show', $supplier)->with('success', __('supplier.save'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Supplier $supplier
     * @return View
     */
    public function edit(Supplier $supplier)
    {
        return view('admin.supplier.edit')->with('supplier', $supplier);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SupplierRequest $request
     * @param Supplier $supplier
     * @return RedirectResponse
     */
    public function update(SupplierRequest $request, Supplier $supplier)
    {
        $supplier->update($request->supplierFillData());
        return redirect()->back()->with('success', __('supplier.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $supplier
     * @return RedirectResponse
     */
    public function destroy($supplier)
    {
        Supplier::destroy($supplier);
        return redirect()->route('admin.supplier.index')->with('success', __('supplier.deleted'));
    }
}
