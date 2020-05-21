<?php


namespace App\Http\Controllers\Api\v1;


use App\Http\Controllers\Controller;
use App\Product;
use App\Services\PaginateSession;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * фунціонал для api
     * @param Request $request
     * @param PaginateSession $paginateSession
     * @return JsonResponse
     */
    public function index(Request $request,  PaginateSession $paginateSession)
    {
        $sorting = $request->except('limit', 'status');
        $sorting['status'] = '1';
        $products = Product::filter($sorting)->allRelations()->paginate($paginateSession->getLimit());
        return response()->json($products);
    }

    public function search(Request $request,  PaginateSession $paginateSession)
    {
        $products = Product::filter(['search' => $request->q])->paginate($paginateSession->getLimit(), ['id', 'title as text']);
        return response()->json($products);
    }
}
