<?php

namespace App\Http\Controllers;


use App\Repositories\ShippingRepository;
use App\Tasks\Shipping\GetCitiesByNameTask;
use App\Tasks\Shipping\GetCityByRefTask;
use Illuminate\Http\Request;

class ShippingController extends Controller
{

    private $shippingRepository;

    /**
     * ShippingController constructor.
     * @param ShippingRepository $shippingRepository
     */
    public function __construct()
    {
        $this->shippingRepository = ShippingRepository::getInstance();
    }

    /**
     * @param $city
     * @return \Illuminate\Http\JsonResponse
     */
    public function apiGetCity($city)
    {

//        dd((new GetCitiesByNameTask())->get($city)['0']->Description);
        return response()->json(
            $this->shippingRepository->findCity($city)
        );
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function apiGetCityPost(Request $request)
    {
        return response()->json(
            $this->shippingRepository->findCity($request->input('city'))
        );
    }

    /**
     * @param $warehouses
     * @return \Illuminate\Http\JsonResponse
     */
    public function apiGetWarehouses($warehouses)
    {
//        dd((new GetCityByRefTask())->get($warehouses));
        return response()->json(
            $this->shippingRepository->findWarehouses($warehouses)
        );
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function apiGetWarehousesPost(Request $request)
    {
        return response()->json(
            $this->shippingRepository->findWarehouses($request->input('warehouses'))
        );
    }


}
