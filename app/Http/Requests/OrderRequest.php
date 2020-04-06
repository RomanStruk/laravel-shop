<?php

namespace App\Http\Requests;

use App\Rules\PhoneNumber;
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

            'shipping_method' => 'required|in:courier,novaposhta',
//            'city' => 'required|string',
            'city_ref' => 'required|string',

            'street' => 'required_if:shipping_method,courier|string',
            'house' => 'required_if:shipping_method,courier|numeric',
            'flat' => 'required_if:shipping_method,courier|numeric',

            'warehouse_ref' => 'required_if:shipping_method,novaposhta|string',

            'method_pay' => ['required', Rule::in(['receipt', 'google-pay', 'card'])],
            'paid' => 'required|boolean',
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
            'street'        => $this->street,
            'house'         => $this->house,
            'flat'          => $this->flat,
            'warehouse_ref' => $this->warehouse_ref,
            'city_ref'      => $this->city_ref,
        ];
    }
}
