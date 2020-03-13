<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Product;
use App\Services\Attribute\GetAttributes;
use App\Services\Category\GetCategories;
use App\Services\Product\DeleteProductById;
use App\Services\Product\GetProductByIdOrSlug;
use App\Services\Product\GetProductsByLimit;
use App\Services\Product\UpdateProductById;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
    public function index(Request $request, GetProductsByLimit $getProducts, GetCategories $categories)
    {
        $products = $getProducts->handel(
            $request->except('limit'),
            $request->get('limit')
        );
//        dd($products);
        return view('admin.product.index')
            ->with('categories', $categories->handel())
            ->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param GetProductByIdOrSlug $getProduct
     * @param GetAttributes $getAttributes
     * @param int $id
     * @return Factory|View
     */
    public function show(GetProductByIdOrSlug $getProduct, GetAttributes $getAttributes, $id)
    {
        $product = $getProduct->handel($id);
        $attributes = $getAttributes->handel();
//        dd($attributes->firstWhere('id', '=', '1')->allAttributes);
//        dd($product);
        return view('admin.product.show')
            ->with('product', $product)
            ->with('attributes', $attributes);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param GetProductByIdOrSlug $getProduct
     * @param GetCategories $getCategories
     * @param GetAttributes $getAttributes
     * @param $id
     * @return Factory|View
     */
    public function edit(GetProductByIdOrSlug $getProduct,
                         GetCategories $getCategories,
                         GetAttributes $getAttributes,
                         $id)
    {
        $product = $getProduct->handel($id);
        $categories = $getCategories->handel(false);
        $groups = $getAttributes->handel();
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
    public function update(ProductRequest $request, UpdateProductById $updateProductById, $productId)
    {
        $update = $request->only([
            'title',
            'alias',
            'category_id',
            'keywords',
            'description',
            'content',
            'price',
            'status',
            'in_stock',
        ]);
        $attributes = $request->input('attributes');
        $updateProductById->handel($productId, $update, $attributes);
        return redirect()->back()->with('success', __('product.update'));;
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
        $deleteProductById->handel($product, true);
        return redirect()->back()->with('success', __('product.delete'));
    }
}
