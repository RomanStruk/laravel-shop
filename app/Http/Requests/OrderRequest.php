<?php

namespace App\Http\Requests;

use App\Rules\PhoneNumber;
use App\Rules\ShippingCityRule;
use App\Services\Data\Shipping\GetCityByRef;
use App\Services\Data\Shipping\GetWarehousesByCityRef;
use App\Services\Shipping\ShippingInterface;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrderRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'phone' => ['required', new PhoneNumber],

            'products' => 'required|array|min:1',
            'products.*' => 'numeric|exists:products,id',

            'method_pay' => ['required', Rule::in(['receipt', 'google-pay', 'card'])],
            'paid' => 'required|boolean',

            'shipping_method' => ['required', 'in:courier,novaposhta'],

            'city_ref'  => ['required', 'string', new ShippingCityRule],
            'city'      => ['required', 'string'],
            'region'    => ['nullable'],
            'area'      => ['nullable'],

            'street'    => 'required_if:shipping_method,courier|string',
            'house'     => 'required_if:shipping_method,courier|numeric',
            'flat'      => 'required_if:shipping_method,courier|numeric',

            'warehouse_ref' => ['required_if:shipping_method,novaposhta', 'string'],
            'warehouse_title'=> ['nullable'],
        ];
    }

    public function passedValidation(){
        $api = resolve(ShippingInterface::class);;

        $getCityByRef = new GetCityByRef($api);

        $cityInformation = $getCityByRef->handel($this->city_ref);
        $this->city = $cityInformation['Description'];
        $this->region = $cityInformation['RegionsDescription'];
        $this->area = $cityInformation['AreaDescription'];
//dd($cityInformation);
        if ($this->shipping_method == 'novaposhta'){
            $getWarehousesByCityRef = new GetWarehousesByCityRef($api);
            $warehouses = $getWarehousesByCityRef->handel($this->city_ref);
            $this->warehouse_title = 'Don`t choose';
            if (key_exists($this->warehouse_ref, $warehouses)){
//                dd($warehouses, gettype($warehouses[$this->warehouse_ref]));
                $this->warehouse_title = $warehouses[$this->warehouse_ref]['Description'];
            }
        }
        return;
    }

    /**
    * Return the fields and values to update Payment.
    *
    * @return array
    */
    public function paymentFillData()
    {
        return [
            'method'    => $this->method_pay,
            'paid'      => $this->paid,
        ];
    }

    /**
     * Return the fields and values to update UserDetail.
     *
     * @return array
     */
    public function userDetailFillData():array
    {
        return [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'phone' => $this->phone,
        ];
    }

    /**
     * Return the fields and values to create/update a new shipping.
     *
     * @return array
     */
    public function shippingFillData()
    {
        return [
            'method'        => $this->shipping_method,

            'city_ref'      => $this->city_ref,
            'city'          => $this->city,

            'street'        => $this->street,
            'house'         => $this->house,
            'flat'          => $this->flat,

            'warehouse_ref' => $this->warehouse_ref,
            'warehouse_title' => $this->warehouse_title,
        ];
    }
}
