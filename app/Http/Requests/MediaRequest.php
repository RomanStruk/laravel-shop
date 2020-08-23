<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Collection;

class MediaRequest extends FormRequest
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
            'name' => ['nullable', 'filled', 'between:4,255'],
            'keywords' => ['nullable', 'string', 'filled', 'between:4,255'],
            'description' => ['nullable', 'string', 'filled', 'between:4,255'],
            'products' => ['nullable', 'array'],
            'products.*' => ['nullable', 'exists:products,id'],
            'media.*' => request()->method() == 'POST'?
                ['mimes:png,jpeg,jpg']:
                ['nullable'],
//            'disc' => ['required', 'in:public,local'],
            'visibility' => ['nullable', 'boolean'],
        ];
    }

    public function mediaFillData():Collection
    {
        return collect([
            'name'          => $this->name,
            'keywords'      => $this->keywords,
            'description'   => $this->description,
//            'disc'          => $this->disc,
            'disc'          => 'public',
            'visibility'    => $this->visibility ? 'public':'private',
        ]);
    }

    public function willUpdateRelationProducts(): bool
    {
        return $this->products !== null;
    }
    public function productsFillData():Collection
    {
        return collect($this->products);
    }
}
