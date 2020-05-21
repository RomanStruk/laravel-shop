<?php

namespace App\Http\Controllers;

use App\Product;
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
     * @param string $category alias
     * @return View|Factory
     */
    public function index2(Request $request, $category = '')
    {
        $sorting = $request->except('limit');
        if ($category) $sorting['category'] = $category;
        $sorting['status'] = '1';
        $products = Product::filter($sorting)->paginate($request->get('limit'));
        return view('shop', ['products' => $products]);
    }

    /**
     * Відображення сторінки з продуктом
     * @param $alias
     * @return Factory|View
     */
    public function show($alias)
    {
        // get product
        $product = Product::allRelations()->avgRating()->countComments()->where('alias', $alias)->firstOrFail();

        //оновлення кількості переглядів
        $product->visits ++;

        // disable the timestamps before saving
        $product->timestamps = false;

        // save
        $product->save();

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
