<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'name' => ['required', 'filled', 'between:4,255'],
            'keywords' => ['required', 'string', 'filled', 'between:4,255'],
            'description' => ['required', 'string', 'filled', 'between:4,255'],
            'products' => ['nullable', 'array'],
            'products.*' => ['nullable', 'exists:products,id'],
            'media.*' => request()->method() == 'POST'?
                ['mimes:png,jpeg,jpg']:
                ['nullable'],
            'disc' => ['required', 'in:public,local'],
            'visibility' => ['required', 'in:public,private'],
        ];
    }

    public function mediaFillData():array
    {
        return [
            'name'          => $this->name,
            'keywords'      => $this->keywords,
            'description'   => $this->description,
            'disc'          => $this->disc,
            'visibility'    => $this->visibility,
        ];
    }
    public function productsFillData():array
    {
        return $this->products ?? [];
    }
}
