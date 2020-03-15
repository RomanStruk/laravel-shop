<?php

namespace App\Http\Requests;

use Auth;
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
            'title' => ['required', 'filled', 'between:4,255'],
            'alias' => [
                'required',
                Rule::unique('products', 'alias')->ignore($this->route('product'))
            ],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'keywords' => ['required', 'string', 'filled', 'between:4,255'],
            'description' => ['required', 'string', 'filled', 'between:4,255'],
            'content' => ['required', 'string', 'filled'],
            'price' => ['required', 'numeric', 'min:1'],
            'status' => ['required', 'in:1,0'],
            'in_stock' => ['required', 'integer', 'min:1'],
            'attributes' => ['array', 'distinct', 'exists:attributes,id'],
            'media' => 'required',
            'media.*' => 'mimes:png,jpeg,jpg'
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge(['status' => $this->has('status') ? 1 : 0]);
        if (empty($this->alias)){
            $this->merge(['alias' => \Str::slug($this->title). rand(1,99)]);
        }
    }

}
