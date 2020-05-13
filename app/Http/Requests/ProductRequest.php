<?php

namespace App\Http\Requests;

use App\Product;
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
            'alias' => request()->method() == 'PATCH' ? [
                'required',
                Rule::unique('products', 'alias')->ignore($this->route('product'))
            ] : [
                'required',
                'unique:products,alias'
            ],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'keywords' => ['required', 'string', 'filled', 'between:4,255'],
            'description' => ['required', 'string', 'filled', 'between:4,255'],
            'content' => ['required', 'string', 'filled'],
            'price' => ['required', 'numeric', 'min:1'],
            'status' => ['required', 'in:1,0'],
            'attributes' => ['required', 'array', 'distinct', 'exists:attributes,id'],
            'related' => ['array', 'distinct', 'exists:products,id'],
            'media' => ['required', 'array', 'exists:media,id'],

            'supplier' => [request()->method() == 'POST' ? 'required' : 'nullable', 'integer', 'exists:suppliers,id'],
            'imported' => ['required_with:supplier', 'integer', 'min:1'],
        ];
    }

    public function syllableFillData():array
    {
        return $this->get('supplier') ?
            [
                'supplier_id' => $this->get('supplier'),
                'imported' => $this->get('imported'),
                'remains' => $this->get('imported'),
                'processed' => 0,
            ]: [];
    }

    public function attributesFillData():array
    {
        return $this->get('attributes') ?: [];
    }

    public function mediaFillData():array
    {
        return $this->get('media');
    }

    public function relatedFillData():array
    {
        return $this->get('related') ?: [];
    }

    public function productFillData():array
    {
        return [
            'title'         => $this->get('title'),
            'alias'         => $this->get('alias'),
            'category_id'   => $this->get('category_id'),
            'keywords'      => $this->get('keywords'),
            'description'   => $this->get('description'),
            'content'       => $this->get('content'),
            'price'         => $this->get('price'),
            'status'        => $this->get('status'),
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge(['status' => $this->has('status') ? 1 : 0]);
        if (empty($this->alias) and !empty($this->title)) {
            $this->merge(['alias' => \Str::slug($this->title) . rand(1, 99)]);
        }
    }

}
