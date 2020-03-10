<?php

namespace App\Http\Controllers;

use App\Category;
use App\Order;
use App\Product;
use App\Repositories\ProductRepository;
use App\Repositories\RepositoryInterface\ProductRepositoryInterface;
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
     *
     * Запит на БД має вибирати через OR атриьути в групі і через AND між групами
     * SELECT * FROM `product_attribute` WHERE `attribute_id` = 2 OR `attribute_id`=1
     * SELECT * FROM `products` WHERE `status` = '1' AND EXISTS( SELECT 1 FROM `product_attribute` WHERE product_attribute.product_id = products.id AND product_attribute.attribute_id IN (1,2) ) AND EXISTS( SELECT 1 FROM `product_attribute` WHERE product_attribute.product_id = products.id AND product_attribute.attribute_id = 17 )
     *
     * @param Request $request
     * @param array $filters
     * @param string $category
     * @param string $sort_by
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    private function getProducts(Request $request, $filters = [], $category = '', $sort_by = '')
    {
        if ($request->has('filter') and !$filters) {
            $filter = $request->get('filter');
            foreach ($filter as $f) {
                $param = explode('-', $f);
                $filters[$param[0]][] = (int)$param[1];
            }
        }
        $category = ($request->has('category') && !$category) ? (int)$request->get('category') : $category;
        $sort_by = ($request->has('sorter') && !$sort_by) ? $request->get('sorter') : $sort_by;
        $product = $this->productRepository->showProductsWithFormat($filters, $category, $sort_by);
        (function () use (&$product) {
            collect($product->items())->map(function ($child) {
                $child['rating'] = $child->comments->avg('rating'); // середній рейтинг
                return $child;
            });
        })();
        return $product;

    }

    /**
     * фунціонал для api
     * @param Request $request
     * @return JsonResponse
     */
    public function apiShowProducts(Request $request)
    {
        return response()->json(
            $this->getProducts($request)
        );
    }

    /**
     * Відображення даних по get запиту
     * @param Request $request
     * @param string $category alias
     * @param array $filters
     * @return View|Factory
     */
    public function showProducts(Request $request, $category = '', $filters = [])
    {
        $sorting = ($request->post() and $request->has('sorter')) ? $request->get('sorter') : 'popular';
//        $products = $this->productRepository->showProductsWithFormat($filters, $category, $sorting);
        return view('shop', ['products' => $this->getProducts($request, $filters, $category, $sorting)]);
    }

    /**
     * Відображення сторінки з продуктом
     * @param $alias
     * @return Factory|View
     */
    public function showSingleProduct($alias)
    {
        $product = $this->productRepository->findByAlias($alias);
        $product['rating'] = $product->comments->avg('rating'); // середній рейтинг
        $product['count_comments'] = $product->comments->count(); // кількість коментарів
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

        dd(DB::getQueryLog());
        dd($order);
        //return view('index');
    }
}
