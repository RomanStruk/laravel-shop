<?php

namespace App\Http\Requests;

use App\Product;
use Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;

class ProductUpdateRequest extends FormRequest
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
            'title'         => ['nullable', 'filled', 'between:4,255'],
            'alias' => [
                'nullable',
                Rule::unique('products', 'alias')->ignore($this->route('product'))
            ],
            'category_id'   => ['nullable', 'integer', 'exists:categories,id'],
            'keywords'      => ['nullable', 'string', 'filled', 'between:4,255'],
            'description'   => ['nullable', 'string', 'filled', 'between:4,255'],
            'content'       => ['nullable', 'string', 'filled'],
            'price'         => ['nullable', 'numeric', 'min:1'],
            'status'        => ['nullable', 'in:1,0'],
            'filters'       => ['nullable', 'array', 'distinct', 'exists:filters,id'],
            'related'       => ['nullable', 'distinct', 'exists:products,id'],
            'media'         => ['nullable', 'array', 'exists:media,id'],

            'supplier_id'      => ['nullable', 'integer', 'exists:suppliers,id'],
            'imported'      => ['required_with:supplier', 'integer', 'min:1'],
        ];
    }

    public function ifNeedUpdateSyllable(): bool
    {
        return $this->get('supplier') !== null;
    }
    public function syllableFillData(): Collection
    {
        return collect([
            'supplier_id' => $this->get('supplier_id'),
            'imported' => $this->get('imported'),
            'remains' => $this->get('imported'),
            'price' => $this->get('price'),
        ]);
    }

    public function ifNeedUpdateFilters(): bool
    {
        return $this->get('filters') !== null;
    }

    public function filtersFillData(): Collection
    {
        return collect($this->get('filters'));
    }

    public function ifNeedUpdateMedia(): bool
    {
        return $this->get('media') !== null;
    }

    public function mediaFillData(): Collection
    {
        return collect($this->get('media'));
    }

    public function ifNeedUpdateRelatedProducts(): bool
    {
        return $this->get('related') !== null;
    }

    public function relatedFillData(): Collection
    {
        return collect($this->get('related'));
    }

    public function productFillData(): Collection
    {
        return collect([
            'title' => $this->get('title'),
            'alias' => $this->get('alias'),
            'category_id' => $this->get('category_id'),
            'keywords' => $this->get('keywords'),
            'description' => $this->get('description'),
            'content' => $this->get('content'),
            'price' => $this->get('price'),
            'status' => $this->get('status'),
        ]);
    }

    protected function prepareForValidation()
    {
        $this->merge(['status' => $this->has('status') ? 1 : 0]);
        if (empty($this->alias) and !empty($this->title)) {
            $this->merge(['alias' => \Str::slug($this->title) . rand(1, 99)]);
        }
    }

}
