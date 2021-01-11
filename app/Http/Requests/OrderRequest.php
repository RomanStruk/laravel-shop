<?php

namespace App\Http\Requests;

use App\Rules\OrderProductMinRule;
use App\Rules\ProductHasSyllableRule;
use App\Rules\ShippingCityRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
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
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'products' => ['required','array','distinct','min:1', new OrderProductMinRule(), new ProductHasSyllableRule()],

            'comment' => 'nullable|string|min:3',

            'products.*.id' => ['required', 'numeric', 'min:1', 'exists:products,id'],
            'products.*.count' => ['required', 'numeric', 'min:1', 'max:999'],
            'method_pay' => ['required', Rule::in(['receipt', 'google-pay', 'card'])],
            'shipping_method' => ['required', 'in:courier,novaposhta'],
            'city_code'  => ['required', 'string', new ShippingCityRule],

            'street'    => 'required_if:shipping_method,courier|nullable|string',
            'house'     => 'required_if:shipping_method,courier|nullable|string',
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
            'comment' => $this->comment,
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
            'method' => $this->method_pay,
        ];
    }

    /**
     * Return the fields and values to update Payment.
     *
     * @return array
     */
    public function productsFillData()
    {
        $result = [];
        foreach ($this->products as $element){
            $result[] = [
                'product_id' => $element['id'],
                'syllable_id' => null,
                'count' => $element['count'],
            ];
        }
        return $result;
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

            'city'     => $this->city_code,
            'address' => $this->shipping_method == 'novaposhta'?
                $this->warehouse_code :
                ($this->street .', '. $this->house . ', ' . $this->flat),
        ];
    }
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'products.*.id.required' => 'Products is required',
            'products.*.id.numeric' => 'Products is numeric',
            'products.*.id.exists' => 'Products is exists',

            'products.*.count.required_with' => 'Products count is required',
            'products.*.count.numeric' => 'Products count is numeric',
            'products.*.count.min' => 'Products count is min',
            'products.*.count.max' => 'Products count is max',

        ];
    }

}
