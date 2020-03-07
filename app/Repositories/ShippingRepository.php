<?php


namespace App\Repositories;
use App\Shipping as Model;
// Доставка
class ShippingRepository extends Repository
{

    const KEY = 'f2595f7fe8718f38f17195c10127fcb2';
    const URL = 'https://api.novaposhta.ua/v2.0/json/';

    private function apiData($api_key, $model, $method, $rule, $find, $limit = 5){
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
            return "cURL Error #:" . $err;
        } else {
            return json_decode($response);
        }
    }

    public function findCity($city)
    {
        $api_key = 'f2595f7fe8718f38f17195c10127fcb2';
        $model = 'AddressGeneral';
        $method = 'getSettlements';
        $rule = 'FindByString';
        return $this->apiData($api_key, $model, $method, $rule, $city);
    }

    public function findRef($ref)
    {
        $api_key = 'f2595f7fe8718f38f17195c10127fcb2';
        $model = 'AddressGeneral';
        $method = 'getSettlements';
        $rule = 'Ref';
        return $this->apiData($api_key, $model, $method, $rule, $ref);
    }

    public function findWarehouses($warehouses)
    {
        $api_key = 'f2595f7fe8718f38f17195c10127fcb2';
        $model = 'AddressGeneral';
        $method = 'getWarehouses';
        $rule = 'SettlementRef';
        return $this->apiData($api_key, $model, $method, $rule, $warehouses);
    }

    public function getParserWarehouses($warehouses)
    {
        $data = collect($this->findWarehouses($warehouses));
        if (count($data->get('errors'))>=1) return false;
//        dd($data);
        $result = [];
        foreach ($data->get('data') as $item) {
            $result[$item->Ref] = $item->Description;
        }
        return $result;
    }

    public function parserResult($data)
    {
        $data = collect($data);
//        dd($result);
        if (count($data->get('errors'))>=1) return false;
        if ($data->get('info')->totalCount <> 1) return false;
        return [
            'city_ref' => $data->get('data')[0]->Ref,
            'city' => $data->get('data')[0]->SettlementTypeDescription. ' '. $data->get('data')[0]->Description,
            'region' => $data->get('data')[0]->RegionsDescription,
            'area' => $data->get('data')[0]->AreaDescription,
        ];
    }

    public function update(Model $shipping, $input)
    {

        if ($shipping->city_ref != $input['city_ref']){
            $city = $this->findRef($input['city_ref']);
            $data = $this->parserResult($city);
            if ($data){
                $input += $data;
            }
        }elseif ($input['method'] == 'novaposhta'){
            $warehouses = $this->getParserWarehouses($input['city_ref']);
            $input['warehouse_title'] = 'Don`t choose';
            if (key_exists('warehouse_ref', $warehouses)){
                $input['warehouse_title'] = $warehouses[$input['warehouse_ref']];
            }
        }
        $shipping->update($input);
    }
}
