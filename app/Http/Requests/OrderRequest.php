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
}
