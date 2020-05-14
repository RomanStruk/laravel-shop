<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use App\OrderProduct;
use App\Supplier;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Product;
use App\Category;
use App\Filter;
use App\Services\Analytics\Analytics;
use App\Services\Analytics\DateGeneration;
use App\Services\PaginateSession;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param PaginateSession $paginateSession
     * @return Factory|View
     */
    public function index(Request $request, PaginateSession $paginateSession)
    {
        $filters = $request->except('limit');
        $filters['date'] = 'desc';

        $products = Product::filter($filters)->with('category')->paginate($paginateSession->getLimit());
//        dd($products);
        return view('admin.product.index')
            ->with('categories', Category::allRelations(false)->get())
            ->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        $categories = Category::allRelations(false)->get();
        $filters = Filter::allRelations()->get();
        $suppliers = Supplier::all();
//        dd(count($filters->first()->filterValues->pluck('id')->intersect([1]))?:false);
        return view('admin.product.create')
            ->with('categories', $categories)
            ->with('filters', $filters)
            ->with('suppliers', $suppliers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductRequest $request
     * @return RedirectResponse
     */
    public function store(ProductRequest $request)
    {
        $product = new Product($request->productFillData());
        $product->save();
        $product->syncAttributesOfFilters($request->attributesFillData());
        $product->syncMediaFiles($request->mediaFillData());
        $product->syncRelatedProducts($request->relatedFillData());
        $product->createSyllable($request->syllableFillData());

        return redirect()->route('admin.product.show', ['product' => $product->id])
            ->with('success', __('product.save'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Factory|View
     */
    public function show($id)
    {
        dd(OrderProduct::top(5)->get()->first()->product->orderProduct()->countProductGroupByWeek()->get());

        $product = Product::allRelations()->withTrashed()->avgRating()->countComments()->findOrFail($id);
//        dd($product->orderProduct);
        $attributes = Filter::allRelations()->get();
        // statistics card
        $range = (new DateGeneration())->generateStartEndMonth(now());
        $rangeLastMonth = (new DateGeneration())->generateStartEndMonth(now()->subMonth());

//        dd($product->orderProduct()->sold($range)->get()->sum('count'));


        $soldProductCount = $product->orderProduct()->sold($range)->get()->sum('count');
        $soldProductCountLastMonth = $product->orderProduct()->sold($rangeLastMonth)->get()->sum('count');
        $soldProductsOverTime = $product->orderProduct()->sold(null)->get()->sum('count');
        $progress = (new Analytics())->growthRates($soldProductCount, $soldProductCountLastMonth);
        // end
        return view('admin.product.show')
            ->with('product', $product)
            ->with('attributes', $attributes)
            ->with('soldProductCount', $soldProductCount)
            ->with('soldProductsOverTime', $soldProductsOverTime)
            ->with('progress', $progress);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return Factory|View
     */
    public function edit($id)
    {
        $product = Product::allRelations()->withTrashed()->findOrFail($id);;
        $categories = Category::allRelations(false)->get();
        $groups = Filter::allRelations()->get();
        $suppliers = Supplier::all();
//        dd(in_array('4', $product->product_attributes->pluck('id')->toArray()));
//        dd($product->product_attributes->pluck('id')->toArray());
//        dd($product, $groups);
        return view('admin.product.edit')
            ->with('product', $product)
            ->with('categories', $categories)
            ->with('groups', $groups)
            ->with('suppliers', $suppliers);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductRequest $request
     * @param $productId
     * @return RedirectResponse
     */
    public function update(ProductRequest $request, $productId)
    {
        $product = Product::findOrFail($productId);
        $product->update($request->productFillData());

        $product->syncRelatedProducts($request->relatedFillData());

        $product->syncMediaFiles($request->mediaFillData());

        $product->syncAttributesOfFilters($request->attributesFillData());

        $product->createSyllable($request->syllableFillData());

        return redirect()->back()->with('success', __('product.update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return RedirectResponse
     */
    public function destroy($product)
    {
        Product::destroy($product);
        return redirect()->route('admin.product.index')->with('success', __('product.delete'));
    }
}
