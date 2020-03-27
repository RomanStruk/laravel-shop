<?php

namespace App\Http\Controllers;

use App\Category;
use App\Order;
use App\Product;
use App\Repositories\ProductRepository;
use App\Repositories\RepositoryInterface\ProductRepositoryInterface;
use App\Services\Product\GetProductsByLimit;
use DB;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{

    private $productRepository;

    public function __construct()
    {
        $this->productRepository = ProductRepository::getInstance();
    }

    public function index()
    {
        return view('vue.shop');
    }

    /**
     * фунціонал для api
     * @param Request $request
     * @param GetProductsByLimit $getProducts
     * @return JsonResponse
     */
    public function apiShowProducts(Request $request, GetProductsByLimit $getProducts)
    {
        $sorting = $request->except('limit');
        $sorting['status'] = '1';
        $products = $getProducts->handel(
            $sorting,
            ['*'],
            $request->get('limit')
        );
        return response()->json($products);
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
     * @param $alias
     * @return Factory|View
     */
    public function showSingleProduct($alias)
    {
        $product = $this->productRepository->findByAlias($alias);
        $this->productRepository->updateVisits($product->id); //оновлення кількості переглядів
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
