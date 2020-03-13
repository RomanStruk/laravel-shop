<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
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
            'title' => ['required', 'filled'],
            'alias' => [
                'required',
                Rule::unique('products', 'alias')->ignore($this->route('product'))
            ],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'keywords' => ['required', 'string', 'filled'],
            'description' => ['required', 'string', 'filled'],
            'content' => ['required', 'string', 'filled'],
            'price' => ['required', 'numeric', 'min:0'],
            'status' => ['accepted'],
            'in_stock' => ['required', 'integer', 'min:0'],
            'attributes' => ['array', 'distinct', 'exists:attributes,id']
        ];
    }
}
