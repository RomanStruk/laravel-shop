<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Product;
use App\Services\Data\Filter\GetFilters;
use App\Services\Data\Category\GetCategories;
use App\Services\SaveFile;
use App\Services\Data\Media\SaveToDbMediaFile;
use App\Services\Data\Media\UpdateRelationships;
use App\Services\Data\Product\CreateProductService;
use App\Services\Data\Product\DeleteProductById;
use App\Services\Data\Product\GetProductByIdOrSlug;
use App\Services\Data\Product\GetProductsByLimit;
use App\Services\Data\Product\UpdateProductById;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param GetProductsByLimit $getProducts
     * @param GetCategories $categories
     * @return Factory|View
     */
    public function index(Request $request,
                          GetProductsByLimit $getProducts,
                          GetCategories $categories)
    {
        $filters = $request->except('limit');
        $filters['date'] = 'desc';
        $products = $getProducts->handel(
            $filters,
            ['*']
        );
//        dd($products);
        return view('admin.product.index')
            ->with('categories', $categories->handel(false))
            ->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param GetCategories $getCategories
     * @param GetFilters $getFilters
     * @param GetProductsByLimit $getProducts
     * @return Factory|View
     */
    public function create(GetCategories $getCategories, GetFilters $getFilters, GetProductsByLimit $getProducts)
    {
        $categories = $getCategories->handel(false);
        $filters = $getFilters->handel();
//        dd(count($filters->first()->filterValues->pluck('id')->intersect([1]))?:false);
        return view('admin.product.create')
            ->with('categories', $categories)
            ->with('filters', $filters);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductRequest $request
     * @param CreateProductService $createProductService
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ProductRequest $request, CreateProductService $createProductService)
    {
        $product = $createProductService->handel($request->productFillData());
        $product->syncAttributesOfFilters($request->attributesFillData());
        $product->syncMediaFiles($request->mediaFillData());
        $product->syncRelatedProducts($request->relatedFillData());

        return redirect()->route('admin.product.show', ['product' => $product->id])
            ->with('success', __('product.save'));
    }

    /**
     * Display the specified resource.
     *
     * @param GetProductByIdOrSlug $getProduct
     * @param GetFilters $getAttributes
     * @param int $id
     * @return Factory|View
     */
    public function show(GetProductByIdOrSlug $getProduct, GetFilters $getAttributes, $id)
    {
        $product = $getProduct->handel($id, ['*'], true);
        $attributes = $getAttributes->handel();
        return view('admin.product.show')
            ->with('product', $product)
            ->with('attributes', $attributes);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param GetProductByIdOrSlug $getProduct
     * @param GetCategories $getCategories
     * @param GetFilters $getAttributes
     * @param $id
     * @return Factory|View
     */
    public function edit(GetProductByIdOrSlug $getProduct,
                         GetCategories $getCategories,
                         GetFilters $getAttributes,
                         $id)
    {
        $product = $getProduct->handel($id, ['*'], true);
        $categories = $getCategories->handel(false);
        $groups = $getAttributes->handel();
//        dd(in_array('4', $product->product_attributes->pluck('id')->toArray()));
//        dd($product->product_attributes->pluck('id')->toArray());
//        dd($product, $groups);
        return view('admin.product.edit')
            ->with('product', $product)
            ->with('categories', $categories)
            ->with('groups', $groups);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductRequest $request
     * @param UpdateProductById $updateProductById
     * @param $productId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProductRequest $request,
                           UpdateProductById $updateProductById,
                           $productId)
    {
//        dd($request->productFillData());
        $product = $updateProductById->handel($productId, $request->productFillData());
        $product->syncRelatedProducts($request->relatedFillData());
        $product->syncMediaFiles($request->mediaFillData());
        $product->syncAttributesOfFilters($request->attributesFillData());

        return redirect()->back()->with('success', __('product.update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DeleteProductById $deleteProductById
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(DeleteProductById $deleteProductById, $product)
    {
        $deleteProductById->handel($product, false);
        return redirect()->route('admin.product.index')->with('success', __('product.delete'));
    }
}
