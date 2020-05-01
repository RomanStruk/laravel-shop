<?php


namespace App\Http\Controllers\Api\v1;


use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Resources\UserResource;
use App\Services\Data\Product\GetProductsByLimit;
use App\Services\Data\User\GetUsersByLimit;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function users(Request $request, GetUsersByLimit $getUsersByLimit)
    {
        $users = $getUsersByLimit->handel(['search' => $request->q], ['id', 'email', 'created_at']);
        return UserResource::collection($users);
    }

    public function products(Request $request, GetProductsByLimit $getProductsByLimit)
    {
        $products = $getProductsByLimit->handel(['search' => $request->q]);
        return ProductResource::collection($products);
    }
}