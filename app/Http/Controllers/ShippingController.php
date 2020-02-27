<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShippingController extends Controller
{
    public function apiGetCityPost(Request $request)
    {
//        dd($request->input('city'));
        return $this->apiGetCity($request->input('city'));
    }
    public function apiGetCity($city)
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.novaposhta.ua/v2.0/json/",
            CURLOPT_RETURNTRANSFER => True,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS =>  '{
            "apiKey": "f2595f7fe8718f38f17195c10127fcb2",
            "modelName": "Address",
            "calledMethod": "getCities",
            "methodProperties": {
                "FindByString": "'.$city.'",
                "Limit": 5
                }
            }',
            CURLOPT_HTTPHEADER => ["content-type: application/json",],
        ]);
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            return "cURL Error #:" . $err;
        } else {
//            dd((json_decode($response)));
            return response()->json(json_decode($response));
        }
    }

    public function apiGetWarehouses($warehouses)
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.novaposhta.ua/v2.0/json/",
            CURLOPT_RETURNTRANSFER => True,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS =>  '{
            "apiKey": "f2595f7fe8718f38f17195c10127fcb2",
            "modelName": "AddressGeneral",
            "calledMethod": "getWarehouses",
            "methodProperties": {
                "Language": "ua",
                "CityName": "'.$warehouses.'",
                "Limit": 5
                }
            }',
            CURLOPT_HTTPHEADER => ["content-type: application/json",],
        ]);
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            return "cURL Error #:" . $err;
        } else {
//            dd((json_decode($response)));
            return response()->json(json_decode($response));
        }
    }
}
