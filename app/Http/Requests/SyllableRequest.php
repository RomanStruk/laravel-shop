<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SyllableRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'supplier_id' => ['required', 'integer', 'exists:suppliers,id'],
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'imported' => ['required', 'integer', 'min:1'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0.01'],
        ];
    }

    public function syllableFillData()
    {
        return [
            'supplier_id'   => $this->get('supplier_id'),
            'product_id'    => $this->get('product_id'),
            'imported'      => $this->get('imported'),
            'remains'       => $this->get('imported'),
            'description'   => $this->get('description'),
            'price'         => $this->get('price'),
        ];
    }
}
