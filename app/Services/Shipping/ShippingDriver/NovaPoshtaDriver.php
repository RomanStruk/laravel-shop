<?php


namespace App\Services\Shipping\ShippingDriver;


class NovaPoshtaDriver implements ShippingDriverInterface
{
    const KEY = 'f2595f7fe8718f38f17195c10127fcb2';
    const URL = 'https://api.novaposhta.ua/v2.0/json/';

    private function apiData($model, $method, $rule, $find, $limit = 5){
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => self::URL,
            CURLOPT_RETURNTRANSFER => True,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS =>  '{
            "apiKey": "'.self::KEY.'",
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
            return $err;
        } else {
            return json_decode($response, true);
        }
    }

    /**
     * позволяет загрузить справочников городов Украины (на Украинском или Русском),
     * в которые осуществляется доставка груза компанией «Новая Почта».
     * @param string $cityName Также в методе доступен поиск по строке, для него нужно указать параметр FindByString
     * @return mixed|string
     */
    public function findCityByName($cityName)
    {
        $model = 'AddressGeneral';
        $method = 'getSettlements';
        $rule = 'FindByString';
        return $this->apiData($model, $method, $rule, $cityName);
    }

    /**
     * Справочник населенных пунктов Украины
     * в которые осуществляется доставка груза компанией «Новая Почта».
     * @param string $ref Идентификатор адреса
     * @return mixed|string
     */
    public function findCityByCode($ref)
    {
        $model = 'AddressGeneral';
        $method = 'getSettlements';
        $rule = 'Ref';
        return $this->apiData($model, $method, $rule, $ref);
    }

    /**
     * этот метод загружает справочник отделений «Новая Почта»
     * в рамках населенных пунктов Украины.
     * @param string $cityRef РЕФ города из справочника населенных пунктов Украины
     * @return mixed|string
     */
    public function findAddressByCityCode($cityRef)
    {
        $model = 'AddressGeneral';
        $method = 'getWarehouses';
        $rule = 'SettlementRef'; // РЕФ города из справочника населенных пунктов Украины
        return $this->apiData($model, $method, $rule, $cityRef);
    }
}