<?php

namespace App\Http\Requests;

use App\Rules\ShippingCityRule;
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
            'user' => ['required', 'numeric', 'exists:users,id'],

            'comment' => 'required|string|min:3',

            'products' => 'required|array|distinct|min:1',
            'products.*' => 'numeric|exists:products,id',

            'count.*' => 'numeric|min:1|max:999',
            'count' => 'required|array|min:1',

            'method_pay' => ['required', Rule::in(['receipt', 'google-pay', 'card'])],
            'paid' => 'required|boolean',

            'shipping_method' => ['required', 'in:courier,novaposhta'],
            'shipping_rate' => ['required', 'numeric', 'min:0'],

            'city_code'  => ['required', 'string', new ShippingCityRule],

            'street'    => 'required_if:shipping_method,courier|nullable|string',
            'house'     => 'required_if:shipping_method,courier|nullable|numeric',
            'flat'      => 'required_if:shipping_method,courier|nullable|numeric',

            'warehouse_code' => ['required_if:shipping_method,novaposhta', 'nullable', 'string'],
        ];
    }

    /**
     * Return the fields and values to update Order.
     *
     * @return array
     */
    public function orderFillData()
    {
        return [
            'user_id'    => $this->user,
            'comment'    => $this->comment,
        ];
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
    * Return the fields and values to update Payment.
    *
    * @return array
    */
    public function productsFillData()
    {
        return [
            'products'=>$this->products,
            'count' => $this->count,
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
            'shipping_rate' => $this->shipping_rate,

            'city'     => $this->city_code,
            'address' => $this->shipping_method == 'novaposhta'?
                $this->warehouse_code :
                ($this->street .', '. $this->house . ', ' . $this->flat),
        ];
    }
}
