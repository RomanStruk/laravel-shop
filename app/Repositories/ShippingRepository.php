<?php


namespace App\Repositories;
use App\Shipping as Model;
// Доставка
class ShippingRepository
{
    private function apiData($url, $api_key, $model, $method, $rule, $find, $limit = 5){
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => True,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS =>  '{
            "apiKey": "'.$api_key.'",
            "modelName": "'.$model.'",
            "calledMethod": "'.$method.'",
            "methodProperties": {
                "Language": "ua",
                "'.$rule.'": "'.$find.'",
                "Limit": '.$limit.'
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
            return json_decode($response);
        }
    }

    public function findCity($city)
    {
        $url = "https://api.novaposhta.ua/v2.0/json/";
        $api_key = 'f2595f7fe8718f38f17195c10127fcb2';
        $model = 'AddressGeneral';
        $method = 'getSettlements';
        $rule = 'FindByString';
        return $this->apiData($url, $api_key, $model, $method, $rule, $city);
    }

    public function findWarehouses($warehouses)
    {
        $url = "https://api.novaposhta.ua/v2.0/json/";
        $api_key = 'f2595f7fe8718f38f17195c10127fcb2';
        $model = 'AddressGeneral';
        $method = 'getWarehouses';
        $rule = 'SettlementRef';
        return $this->apiData($url, $api_key, $model, $method, $rule, $warehouses);
    }
}
