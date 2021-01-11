<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Http\Resources\Admin\ProductResource;
use App\Product;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $filters = $request->except('limit');
        $filters['date'] = 'desc';

        $products = Product::filter($filters)->with('category')->paginate($request->limit);
        return ProductResource::collection($products)
            ->additional([
                'message' => 'Retrieve Data is Successfully',
                'success' => true
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductRequest $request
     * @return ProductResource
     */
    public function store(ProductRequest $request)
    {
        $product = new Product($request->productFillData());
        $product->save();
        $product->syncAttributesOfFilters($request->attributesFillData());
        $product->syncMediaFiles($request->mediaFillData());
        $product->syncRelatedProducts($request->relatedFillData());
        $product->createSyllable($request->syllableFillData());
        $product->load(['category', 'media', 'related', 'syllable', 'syllable.supplier', 'product_filters', 'product_filters.filter_group']);
        return (new ProductResource($product))->additional([
            'message' => 'Created',
            'success' => true
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return ProductResource
     */
    public function show($id)
    {
        return (new ProductResource(Product::with(['category', 'media', 'related', 'syllable', 'syllable.supplier', 'product_filters', 'product_filters.filter_group'])
            ->findOrFail($id)))->additional([
                'message' => 'Retrieve Data is Successfully',
                'success' => true
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductUpdateRequest $request
     * @param int $id
     * @return ProductResource
     */
    public function update(ProductUpdateRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->productFillData()->whereNotNull()->all());

        if($request->ifNeedUpdateRelatedProducts())
            $product->syncRelatedProducts($request->relatedFillData()->all());

        if($request->ifNeedUpdateMedia())
            $product->syncMediaFiles($request->mediaFillData()->all());

        if($request->ifNeedUpdateFilters())
            $product->syncAttributesOfFilters($request->filtersFillData()->all());

        if($request->ifNeedUpdateSyllable()){
            $product->createSyllable($request->syllableFillData()->all());
            $product->load('syllable.supplier');
        }

        return (new ProductResource($product))->additional([
            'message' => 'A Product was Updated',
            'success' => true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            if (Product::destroy($id)){
                return response()
                    ->json([
                        'message' => 'Файл успішно видалений',
                        'success' => true
                    ]);
            }else{
                return response()
                    ->json([
                        'message' => __('product.cant_delete'),
                        'success' => false
                    ]);
            }
        } catch (Exception $exception ){
            return response()
                ->json([
                    'message' => $exception->getMessage(),
                    'success' => false
                ]);
        }
    }
}
