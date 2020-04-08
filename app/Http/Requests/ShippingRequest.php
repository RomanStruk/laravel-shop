<?php

namespace App\Http\Requests;

use App\Services\Data\Shipping\GetCityByRef;
use App\Services\Data\Shipping\GetWarehousesByCityRef;
use App\Services\Shipping\ShippingInterface;
use Illuminate\Foundation\Http\FormRequest;

class ShippingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            'shipping_method' => ['required', 'in:courier,novaposhta'],

            'city_ref'  => ['required', 'string'],
            'city'      => ['required', 'string'],
            'region'    => ['required', 'string'],
            'area'      => ['required', 'string'],

            'street'    => 'required_if:shipping_method,courier|string',
            'house'     => 'required_if:shipping_method,courier|numeric',
            'flat'      => 'required_if:shipping_method,courier|numeric',

            'warehouse_ref' => ['required_if:shipping_method,novaposhta', 'string'],
            'warehouse_title'=> ['required_if:shipping_method,novaposhta', 'string'],
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     * @throws \Exception
     */
    protected function prepareForValidation(ShippingInterface $shipping)
    {
        $warehouse_title = null;

        $getCityByRef = new GetCityByRef($shipping);
        $cityInformation = $getCityByRef->handel($this->city_ref);

        if ($this->shipping_method == 'novaposhta'){
            $getWarehousesByCityRef = new GetWarehousesByCityRef($shipping);
            $warehouses = $getWarehousesByCityRef->handel($this->city_ref);
            if (key_exists('warehouse_ref', $warehouses)){
                $warehouse_title = $warehouses[$this->warehouse_ref]->Description;
            }
        }

        $this->merge([
            'city' => $cityInformation['SettlementTypeDescription'].$cityInformation['Description'],
            'region' => $cityInformation['RegionsDescription'],
            'area' => $cityInformation['AreaDescription'],

            'warehouse_title' => $warehouse_title,
        ]);
    }
}
