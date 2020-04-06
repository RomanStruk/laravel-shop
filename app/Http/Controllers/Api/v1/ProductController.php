<?php


namespace App\Http\Controllers\Api\v1;


use App\Http\Controllers\Controller;
use App\Services\Data\Product\GetProductsByLimit;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * фунціонал для api
     * @param Request $request
     * @param GetProductsByLimit $getProducts
     * @return JsonResponse
     */
    public function index(Request $request, GetProductsByLimit $getProducts)
    {
        $sorting = $request->except('limit', 'status');
        $sorting['status'] = '1';
        $products = $getProducts->handel(
            $sorting,
            ['*']
        );
        return response()->json($products);
    }
}
