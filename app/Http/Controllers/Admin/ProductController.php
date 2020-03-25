<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Product;
use App\Services\Attribute\GetAttributes;
use App\Services\Category\GetCategories;
use App\Services\PaginateSession;
use App\Services\SaveFile;
use App\Services\Media\SaveToDbMediaFile;
use App\Services\Media\UpdateRelationships;
use App\Services\Product\CreateProductService;
use App\Services\Product\DeleteProductById;
use App\Services\Product\GetProductByIdOrSlug;
use App\Services\Product\GetProductsByLimit;
use App\Services\Product\UpdateProductById;
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
     * @param PaginateSession $paginateSession
     * @return Factory|View
     */
    public function index(Request $request,
                          GetProductsByLimit $getProducts,
                          GetCategories $categories,
                            PaginateSession $paginateSession)
    {
//        dd($request->except('limit'));
        $filters = $request->except('limit');
        $filters['date'] = 'desc';
        $products = $getProducts->handel(
            $filters,
            ['*'],
            $paginateSession->getLimit()
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
     * @param GetAttributes $getAttributes
     * @return Factory|View
     */
    public function create(GetCategories $getCategories, GetAttributes $getAttributes)
    {
        $categories = $getCategories->handel(false);
        $groups = $getAttributes->handel();
        return view('admin.product.create')
            ->with('categories', $categories)
            ->with('groups', $groups);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductRequest $request
     * @param CreateProductService $createProductService
     * @param UpdateProductById $updateProductById
     * @param SaveFile $saveMediaFile
     * @param SaveToDbMediaFile $dbMediaFileService
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ProductRequest $request,
                          CreateProductService $createProductService,
                          UpdateProductById $updateProductById,
                          SaveFile $saveMediaFile,
                          SaveToDbMediaFile $dbMediaFileService)
    {
        $insertData = $request->validated();
        $productId = $createProductService->handel($insertData);
        $files=[];
        foreach($request->file('media') as $file){
                $fileData = $saveMediaFile->handel($file, 'shop/'.$productId);
                $files[] = $dbMediaFileService->handel($fileData, $insertData['title'], $insertData['keywords'], $insertData['description']);
        }
        $updateProductById->handel($productId, false, $insertData['attributes'], $files);

        return redirect()->route('admin.product.show', ['product' => $productId])
            ->with('success', __('product.save'));
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
     * @param GetAttributes $getAttributes
     * @param $id
     * @return Factory|View
     */
    public function edit(GetProductByIdOrSlug $getProduct,
                         GetCategories $getCategories,
                         GetAttributes $getAttributes,
                         $id)
    {
        $product = $getProduct->handel($id, ['*'], true);
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
     * @param SaveFile $saveMediaFile
     * @param SaveToDbMediaFile $dbMediaFileService
     * @param GetProductByIdOrSlug $getProductByIdOrSlug
     * @param $productId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProductRequest $request,
                           UpdateProductById $updateProductById,
                           SaveFile $saveMediaFile,
                           SaveToDbMediaFile $dbMediaFileService,
                           GetProductByIdOrSlug $getProductByIdOrSlug,
                           $productId)
    {
        $update = $request->only(['title', 'alias', 'category_id', 'keywords', 'description', 'content', 'price', 'status', 'in_stock']);
        $attributes = $request->input('attributes');

        $files=[];
        if ($request->has('files') and $request->input('action') == '1'){
            (new UpdateRelationships())->handel((int)$productId, $request->input('files'), 'detach');
            $files = $getProductByIdOrSlug->handel($productId)->media->pluck('id')->toArray();
        }
        if ($request->has('media')){
            foreach($request->file('media') as $file){
                $fileData = $saveMediaFile->handel($file, 'shop/'.$productId);
                $files[] = $dbMediaFileService->handel($fileData, $update['title'], $update['keywords'], $update['description']);
            }
        }
        $updateProductById->handel($productId, $update, $attributes, $files);
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
        return redirect()->back()->with('success', __('product.delete'));
    }
}
