<?php

namespace App\Http\Requests;

use App\Rules\AvailableRemainsProductRule;
use App\Rules\OrderProductMinRule;
use App\Rules\ShippingCityRule;
use App\Rules\SyllableForProductRule;
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

            'products' => ['required','array','distinct','min:1', new OrderProductMinRule()],

            'products.*.id' => 'nullable|numeric|exists:products,id',
            'products.*.count' => ['required_with:products.*.id', 'numeric', 'min:1', 'max:999'],
            'products.*.syllable' => [
                'required_with:products.*.id',
                'numeric',
                'min:1',
                'exists:syllables,id',
                'bail',
                new SyllableForProductRule($this->get('products')),
                new AvailableRemainsProductRule($this->get('products'), $this->order)
            ],
//            'count' => 'required|array|min:1',

            'method_pay' => ['required', Rule::in(['receipt', 'google-pay', 'card'])],
            'paid' => 'required|boolean',

            'shipping_method' => ['required', 'in:courier,novaposhta'],
            'shipping_rate' => ['required', 'numeric', 'min:0'],

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
        $result = [];
        foreach ($this->products as $element){
            if (! array_key_exists('id', $element)) continue;
            $result[] = [
                'product_id' => $element['id'],
                'syllable_id' => $element['syllable'],
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
            'shipping_rate' => $this->shipping_rate,

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

            'products.*.syllable.required_with' => 'A syllable is required',
            'products.*.syllable.numeric' => 'A syllable is numeric',
            'products.*.syllable.exists' => 'A syllable is exists',
        ];
    }
}
