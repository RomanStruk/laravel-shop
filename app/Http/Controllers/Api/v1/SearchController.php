<?php


namespace App\Http\Controllers\Api\v1;


use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Resources\UserResource;
use App\Product;
use App\Services\PaginateSession;
use App\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function users(Request $request, PaginateSession $paginateSession)
    {
        $users = User::filter(['search' => $request->q])->paginate($paginateSession->getLimit(), ['id', 'email', 'created_at']);

        return UserResource::collection($users);
    }

    public function products(Request $request, PaginateSession $paginateSession)
    {
        $products = Product::filter(['search' => $request->q])->paginate($paginateSession->getLimit());
        return ProductResource::collection($products);
    }
}
