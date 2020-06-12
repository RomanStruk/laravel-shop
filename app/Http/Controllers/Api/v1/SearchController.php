<?php


namespace App\Http\Controllers\Api\v1;


use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Resources\SearchShippingCity;
use App\Http\Resources\UserResource;
use App\Product;
use App\Services\PaginateSession;
use App\Services\Shipping\ShippingBase;
use App\Services\Shipping\ShippingMethods\CourierMethod;
use App\Services\Shipping\ShippingMethods\NovaPoshtaMethod;
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
//        response()->header('Access-Control-Allow-Origin', '*')
        return ProductResource::collection($products);
    }

    public function shippingCity(Request $request)
    {
        // todo shippings method
        $shipping = [
            'novaposhta' => NovaPoshtaMethod::class,
            'courier' => CourierMethod::class,
        ];
        $request->validate(['shipping_method' => 'required','q' => 'required']);
        $shippingBase = new ShippingBase($shipping, $request->shipping_method);
        return SearchShippingCity::collection($shippingBase->listAvailableCities($request->q));
    }
}
