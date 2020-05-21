<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SyllableRequest;
use App\Product;
use App\Supplier;
use App\Syllable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SyllableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $syllables = Syllable::with(['supplier','product'])
            ->countProcessed()
            ->countAvailableRemains()
            ->orderBy('product_id')
            ->latest()
            ->paginate();
        return view('admin.syllable.index')->with('syllables', $syllables);
    }


    /**
     * Display the specified resource.
     *
     * @param $syllable
     * @return View
     */
    public function show($syllableId)
    {
        $syllable = Syllable::countProcessed()->countAvailableRemains()->findOrFail($syllableId);
        return view('admin.syllable.show')->with('syllable', $syllable);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return View
     */
    public function create(Request $request)
    {
        $product = $request->get('product')?Product::find($request->get('product'), ['id', 'title']):null;
        return view('admin.syllable.create')->with('product', $product);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SyllableRequest $request
     * @return RedirectResponse
     */
    public function store(SyllableRequest $request)
    {
        $syllable = new Syllable($request->syllableFillData());
        $syllable->save();
        return redirect()->route('admin.syllable.index')->with('success', __('syllable.saved'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Syllable $syllable
     * @return View
     */
    public function edit(Syllable $syllable)
    {
        return view('admin.syllable.edit')->with('syllable', $syllable);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SyllableRequest $request
     * @param Syllable $syllable
     * @return RedirectResponse
     */
    public function update(SyllableRequest $request, Syllable $syllable)
    {
        $syllable->update($request->syllableFillData());
        return redirect()->back()->with('success', __('syllable.updated'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        $syllable = Syllable::findOrFail($id);
        if ($syllable->processed != 0)
            return redirect()->back()->withErrors( __('syllable.cant_delete_processed', ['a'=>$syllable->processed]));
        try {
            $syllable->delete();
            return redirect()->route('admin.syllable.index')->with('success', __('syllable.deleted'));
        }catch (\Exception $exception){
            return redirect()->back()->withErrors($exception);
        }
    }
}
