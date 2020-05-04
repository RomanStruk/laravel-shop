<?php

namespace App\Http\Controllers;

use App\Product;
use App\Services\Data\Product\GetProductByIdOrSlug;
use App\Services\Data\Product\GetProductsByLimit;
use App\Services\Data\Product\UpdateProductVisits;
use DB;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{



    public function index()
    {
        return view('vue.shop');
    }


    /**
     * Відображення даних по get запиту
     * @param Request $request
     * @param GetProductsByLimit $getProducts
     * @param string $category alias
     * @return View|Factory
     */
    public function index2(Request $request, GetProductsByLimit $getProducts, $category = '')
    {
        $sorting = $request->except('limit');
        if ($category) $sorting['category'] = $category;
        $sorting['status'] = '1';

        $products = $getProducts->handel(
            $sorting,
            $request->get('limit')
        );
        return view('shop', ['products' => $products]);
    }

    /**
     * Відображення сторінки з продуктом
     * @param UpdateProductVisits $productVisits
     * @param GetProductByIdOrSlug $getProduct
     * @param $alias
     * @return Factory|View
     */
    public function show(UpdateProductVisits $productVisits,
                                      GetProductByIdOrSlug $getProduct,
                                      $alias)
    {
        $product = $getProduct->handel($alias);
        $productVisits->handel($product->id); //оновлення кількості переглядів
        return view('product', ['product' => $product]);
    }



    public function apiTest(Request $request)
    {
        DB::enableQueryLog();
        $order = Product::with('comments')
            ->withCount(['comments as average_rating' => function ($query) {
                $query->select(DB::raw('coalesce(avg(rating),0)'));
            }])->orderByDesc('average_rating')->paginate(5);

        dd(DB::getQueryLog(), $order);
        //return view('index');
    }
}
