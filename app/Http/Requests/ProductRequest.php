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
//        dd(request()->method());
        return [
            'title' => ['required', 'filled', 'between:4,255'],
            'alias' => request()->method() == 'PATCH'?[
                'required',
                Rule::unique('products', 'alias')->ignore($this->route('product'))
            ]:[
                'required',
                'unique:products,alias'
            ],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'keywords' => ['required', 'string', 'filled', 'between:4,255'],
            'description' => ['required', 'string', 'filled', 'between:4,255'],
            'content' => ['required', 'string', 'filled'],
            'price' => ['required', 'numeric', 'min:1'],
            'status' => ['required', 'in:1,0'],
            'in_stock' => ['required', 'integer', 'min:1'],
            'attributes' => ['array', 'distinct', 'exists:attributes,id'],
            'media.*' => request()->method() == 'POST'?
                ['mimes:png,jpeg,jpg']:
                ['nullable', 'mimes:png,jpeg,jpg'],
            'action' =>request()->method() == 'POST'?
                ['nullable']:
                ['required', 'in:0,1'],
            'files' => request()->method() == 'POST'?
                ['nullable']:
                ['required_if:action,1', 'exists:media,id'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge(['status' => $this->has('status') ? 1 : 0]);
        if (empty($this->alias) and ! empty($this->title)){
            $this->merge(['alias' => \Str::slug($this->title). rand(1,99)]);
        }
    }

}
